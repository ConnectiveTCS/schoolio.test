<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display the messaging dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $activeTab = $request->get('tab', 'inbox');

        $query = Message::query();

        switch ($activeTab) {
            case 'sent':
                $query = Message::sent($user->id)->with(['recipient', 'attachments']);
                break;
            case 'unread':
                $query = Message::unread($user->id)->with(['sender', 'attachments']);
                break;
            default: // inbox
                $query = Message::inbox($user->id)->with(['sender', 'attachments']);
                break;
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(15);
        $unreadCount = Message::unread($user->id)->count();

        return view('tenants.messages.index', compact('messages', 'activeTab', 'unreadCount'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create(Request $request)
    {
        $recipientId = $request->get('recipient_id');
        $recipient = null;

        if ($recipientId) {
            $recipient = User::find($recipientId);
        }

        // Get available recipients based on user role
        $recipients = $this->getAvailableRecipients();

        return view('tenants.messages.create', compact('recipients', 'recipient'));
    }

    /**
     * Store a newly created message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'in:low,normal,high,urgent',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        $user = Auth::user();

        // Check if recipient allows messages
        $recipient = User::find($request->recipient_id);
        if (!$recipient->canReceiveMessages()) {
            return back()->with('error', 'The selected recipient is not accepting messages.');
        }

        // Check messaging permissions
        if (!$this->canMessageUser($user, $recipient)) {
            return back()->with('error', 'You do not have permission to message this user.');
        }

        DB::beginTransaction();

        try {
            // Create the message
            $message = Message::create([
                'subject' => $request->subject,
                'content' => $request->content,
                'sender_id' => $user->id,
                'recipient_id' => $request->recipient_id,
                'priority' => $request->priority ?? 'normal',
                'message_type' => $this->determineMessageType($user, $recipient),
            ]);

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $this->storeAttachment($file, $message);
                }
            }

            DB::commit();

            return redirect()->route('tenant.messages.show', $message)
                ->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error sending message', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to send message. Please try again.');
        }
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $user = Auth::user();

        // Check if user can view this message
        if ($message->sender_id !== $user->id && $message->recipient_id !== $user->id) {
            abort(403);
        }

        // Mark as read if user is the recipient
        if ($message->recipient_id === $user->id && $message->isUnread()) {
            $message->markAsRead();
        }

        return view('tenants.messages.show', compact('message'));
    }

    /**
     * Show the form for replying to a message.
     */
    public function reply(Message $originalMessage)
    {
        $user = Auth::user();

        // Check if user can reply to this message
        if ($originalMessage->sender_id !== $user->id && $originalMessage->recipient_id !== $user->id) {
            abort(403);
        }

        // Determine the recipient for the reply
        $recipient = $originalMessage->sender_id === $user->id
            ? $originalMessage->recipient
            : $originalMessage->sender;

        return view('tenants.messages.reply', compact('originalMessage', 'recipient'));
    }

    /**
     * Delete a message (soft delete for the current user).
     */
    public function destroy(Message $message)
    {
        $user = Auth::user();

        if ($message->sender_id === $user->id) {
            $message->deleteBySender();
        } elseif ($message->recipient_id === $user->id) {
            $message->deleteByRecipient();
        } else {
            abort(403);
        }

        return back()->with('success', 'Message deleted successfully.');
    }

    /**
     * Download a message attachment.
     */
    public function downloadAttachment(Message $message, MessageAttachment $attachment)
    {
        $user = Auth::user();

        // Check if user can access this message
        if ($message->sender_id !== $user->id && $message->recipient_id !== $user->id) {
            abort(403);
        }

        // Check if attachment belongs to this message
        if ($attachment->message_id !== $message->id) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($attachment->path)) {
            return back()->with('error', 'File not found.');
        }

        return response()->download(
            Storage::disk('public')->path($attachment->path),
            $attachment->original_name
        );
    }

    /**
     * Get available recipients based on user role and permissions.
     */
    private function getAvailableRecipients()
    {
        $user = Auth::user();
        $userRoles = $user->getRoleNames()->toArray();

        $query = User::where('id', '!=', $user->id)
            ->where('allow_messages', true);

        // Define messaging rules based on roles
        if (in_array('parent', $userRoles)) {
            // Parents can message: staff, teachers, admin, school (general)
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'super-admin', 'teacher', 'staff']);
            });
        } elseif (in_array('student', $userRoles)) {
            // Students can message: staff, teachers, admin
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'super-admin', 'teacher', 'staff']);
            });
        } elseif (in_array('teacher', $userRoles) || in_array('staff', $userRoles)) {
            // Staff/Teachers can message: everyone (staff, students, parents, admin)
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'super-admin', 'teacher', 'staff', 'student', 'parent']);
            });
        } elseif (in_array('admin', $userRoles) || in_array('super-admin', $userRoles)) {
            // Admins can message: everyone
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'super-admin', 'teacher', 'staff', 'student', 'parent']);
            });
        }

        return $query->with('roles')->orderBy('name')->get();
    }

    /**
     * Check if user can message another user.
     */
    private function canMessageUser(User $sender, User $recipient): bool
    {
        $senderRoles = $sender->getRoleNames()->toArray();
        $recipientRoles = $recipient->getRoleNames()->toArray();

        // Admin and super-admin can message anyone
        if (in_array('admin', $senderRoles) || in_array('super-admin', $senderRoles)) {
            return true;
        }

        // Staff and teachers can message anyone
        if (in_array('staff', $senderRoles) || in_array('teacher', $senderRoles)) {
            return true;
        }

        // Parents can message staff, teachers, admin
        if (in_array('parent', $senderRoles)) {
            return !empty(array_intersect($recipientRoles, ['admin', 'super-admin', 'teacher', 'staff']));
        }

        // Students can message staff, teachers, admin
        if (in_array('student', $senderRoles)) {
            return !empty(array_intersect($recipientRoles, ['admin', 'super-admin', 'teacher', 'staff']));
        }

        return false;
    }

    /**
     * Determine message type based on sender and recipient roles.
     */
    private function determineMessageType(User $sender, User $recipient): string
    {
        $senderRoles = $sender->getRoleNames()->toArray();
        $recipientRoles = $recipient->getRoleNames()->toArray();

        // If parent is messaging admin/staff, consider it school general
        if (
            in_array('parent', $senderRoles) &&
            !empty(array_intersect($recipientRoles, ['admin', 'super-admin']))
        ) {
            return 'school_general';
        }

        return 'personal';
    }

    /**
     * Store an attachment for a message.
     */
    private function storeAttachment($file, Message $message): void
    {
        $originalName = $file->getClientOriginalName();
        $filename = time() . '_' . uniqid() . '_' . $originalName;
        $tenantId = tenant('id');

        $directory = "tenant_{$tenantId}/messages";
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $path = $file->storeAs($directory, $filename, 'public');

        if ($path) {
            MessageAttachment::create([
                'message_id' => $message->id,
                'original_name' => $originalName,
                'filename' => $filename,
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        } else {
            throw new \Exception('Failed to store attachment: ' . $originalName);
        }
    }
}
