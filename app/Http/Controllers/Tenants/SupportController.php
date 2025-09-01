<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\TenantSupportTicket;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $query = TenantSupportTicket::with('createdBy');

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->byPriority($request->priority);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Only show tickets created by the current user if they're not an admin
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'super-admin'])) {
            $query->where('created_by_user_id', $user->id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('tenants.support.index', compact('tickets'));
    }

    public function create()
    {
        return view('tenants.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'category' => 'required|in:technical,billing,feature_request,general',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        $user = Auth::user();
        $tenant = tenant();

        // Generate unique ticket number
        $ticketNumber = 'TKT-' . strtoupper(uniqid());

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                try {
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '_' . $originalName;
                    $tenantId = tenant('id');

                    // Ensure the directory exists
                    $directory = "tenant_{$tenantId}/support_tickets";
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }

                    $path = $file->storeAs($directory, $filename, 'public');

                    if ($path) {
                        $attachments[] = [
                            'original_name' => $originalName,
                            'filename' => $filename,
                            'path' => $path,
                            'size' => $file->getSize(),
                            'mime_type' => $file->getMimeType(),
                        ];
                    } else {
                        Log::error('Failed to store attachment', ['filename' => $filename]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error uploading attachment', ['error' => $e->getMessage(), 'filename' => $originalName]);
                    return back()->with('error', 'Failed to upload attachment: ' . $originalName);
                }
            }
        }

        // First create the central ticket
        $centralTicket = $this->createCentralTicket([
            'ticket_number' => $ticketNumber,
            'tenant_id' => $tenant->id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category' => $request->category,
            'attachments' => $attachments,
            'tenant_user_details' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
            ],
        ]);

        if ($centralTicket) {
            // Create tenant-side reference
            $tenantTicket = TenantSupportTicket::create([
                'ticket_number' => $ticketNumber,
                'central_ticket_id' => $centralTicket['id'],
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'category' => $request->category,
                'status' => 'open',
                'attachments' => $attachments,
                'created_by_user_id' => $user->id,
            ]);

            return redirect()->route('tenant.support.show', $tenantTicket)
                ->with('success', 'Support ticket created successfully.');
        }

        return back()->with('error', 'Failed to create support ticket. Please try again.');
    }

    public function show(TenantSupportTicket $ticket)
    {
        // Get replies from central system
        $replies = $this->getCentralTicketReplies($ticket->central_ticket_id);

        // Get central ticket information including assigned admin
        $centralTicket = $this->getCentralTicket($ticket->central_ticket_id);

        return view('tenants.support.show', compact('ticket', 'replies', 'centralTicket'));
    }

    public function reply(Request $request, TenantSupportTicket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        $user = Auth::user();

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                try {
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '_' . $originalName;
                    $tenantId = tenant('id');

                    // Ensure the directory exists
                    $directory = "tenant_{$tenantId}/support_tickets";
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }

                    $path = $file->storeAs($directory, $filename, 'public');

                    if ($path) {
                        $attachments[] = [
                            'original_name' => $originalName,
                            'filename' => $filename,
                            'path' => $path,
                            'size' => $file->getSize(),
                            'mime_type' => $file->getMimeType(),
                        ];
                    } else {
                        Log::error('Failed to store reply attachment', ['filename' => $filename]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error uploading reply attachment', ['error' => $e->getMessage(), 'filename' => $originalName]);
                    return back()->with('error', 'Failed to upload attachment: ' . $originalName);
                }
            }
        }

        // Add reply to central system
        $replyAdded = $this->addCentralTicketReply($ticket->central_ticket_id, [
            'message' => $request->message,
            'attachments' => $attachments,
            'sender_type' => 'tenant_user',
            'sender_details' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
                'tenant_id' => tenant()->id,
                'tenant_name' => tenant()->name,
            ],
        ]);

        if ($replyAdded) {
            return redirect()->back()->with('success', 'Reply added successfully.');
        }

        return back()->with('error', 'Failed to add reply. Please try again.');
    }

    public function downloadAttachment(TenantSupportTicket $ticket, $filename)
    {
        // URL decode the filename in case it contains special characters
        $filename = urldecode($filename);

        Log::info('Download request', [
            'ticket_id' => $ticket->id,
            'filename' => $filename,
            'ticket_attachments_count' => count($ticket->attachments ?? []),
            'replies_count' => $this->getCentralTicketReplies($ticket->central_ticket_id)->count()
        ]);

        // Check if user has access to this ticket
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'super-admin']) && $ticket->created_by_user_id !== $user->id) {
            abort(403, 'Unauthorized access to ticket attachment.');
        }

        $tenantId = tenant('id');

        // Helper closure to resolve actual physical path (handles tenancy storage_path override)
        $resolvePath = function (string $relative) use ($tenantId) {
            $paths = [];
            $storageRoot = str_replace('\\', '/', storage_path());
            $tenantSegment = "tenant{$tenantId}";

            // If storage_path already points inside tenant segment (stancl/tenancy overrides this), don't duplicate it
            if (preg_match('#/' . preg_quote($tenantSegment, '#') . '$#', $storageRoot)) {
                $paths[] = $storageRoot . '/app/public/' . $relative; // storage/tenantX/app/public/...
            } else {
                $paths[] = $storageRoot . '/' . $tenantSegment . '/app/public/' . $relative; // storage/tenantX/app/public/...
            }

            // Fallback: central storage public (in case it was stored centrally)
            $paths[] = storage_path('app/public/' . $relative);

            // Additional fallback: if relative accidentally already contains tenant_ prefix path exactly as stored
            $paths[] = $storageRoot . '/app/public/' . $relative; // storage/app/public/tenant_1/...

            foreach ($paths as $candidate) {
                if (file_exists($candidate)) {
                    return [$candidate, $paths];
                }
            }
            return [null, $paths];
        };

        // Check in ticket attachments first
        if ($ticket->attachments) {
            foreach ($ticket->attachments as $attachment) {
                if (($attachment['filename'] ?? null) === $filename) {
                    [$resolved, $checked] = $resolvePath($attachment['path']);
                    Log::info('Attachment lookup (tenant ticket)', [
                        'tenant_id' => $tenantId,
                        'relative' => $attachment['path'],
                        'checked_paths' => $checked,
                        'found' => (bool) $resolved
                    ]);
                    if ($resolved) {
                        return response()->download($resolved, $attachment['original_name']);
                    }
                }
            }
        }

        // Check in replies from central system
        $replies = $this->getCentralTicketReplies($ticket->central_ticket_id);
        foreach ($replies as $reply) {
            if ($reply->attachments) {
                foreach ($reply->attachments as $attachment) {
                    if (($attachment['filename'] ?? null) === $filename) {
                        [$resolved, $checked] = $resolvePath($attachment['path']);
                        Log::info('Attachment lookup (tenant reply)', [
                            'reply_id' => $reply->id,
                            'tenant_id' => $tenantId,
                            'relative' => $attachment['path'],
                            'checked_paths' => $checked,
                            'found' => (bool) $resolved
                        ]);
                        if ($resolved) {
                            return response()->download($resolved, $attachment['original_name']);
                        }
                    }
                }
            }
        }

        Log::warning('Attachment not found', [
            'ticket_id' => $ticket->id,
            'filename' => $filename
        ]);

        abort(404, 'Attachment not found.');
    }

    protected function createCentralTicket($data)
    {
        try {
            // Switch to central database context (MySQL)
            $originalConfig = config('database.default');
            config(['database.default' => 'mysql']);

            $ticket = SupportTicket::create($data);

            // Restore tenant database context
            config(['database.default' => $originalConfig]);

            return $ticket->toArray();
        } catch (\Exception $e) {
            Log::error('Failed to create central ticket: ' . $e->getMessage());
            return null;
        }
    }

    protected function getCentralTicket($centralTicketId)
    {
        try {
            // Switch to central database context (MySQL)
            $originalConfig = config('database.default');
            config(['database.default' => 'mysql']);

            $ticket = SupportTicket::with('assignedAdmin')->find($centralTicketId);

            // Restore tenant database context
            config(['database.default' => $originalConfig]);

            return $ticket;
        } catch (\Exception $e) {
            Log::error('Failed to get central ticket: ' . $e->getMessage());
            return null;
        }
    }

    protected function getCentralTicketReplies($centralTicketId)
    {
        try {
            // Switch to central database context (MySQL)
            $originalConfig = config('database.default');
            config(['database.default' => 'mysql']);

            $replies = SupportTicketReply::where('support_ticket_id', $centralTicketId)
                ->where('is_internal', false)
                ->orderBy('created_at', 'asc')
                ->get();

            // Restore tenant database context
            config(['database.default' => $originalConfig]);

            return $replies;
        } catch (\Exception $e) {
            Log::error('Failed to get central ticket replies: ' . $e->getMessage());
            return collect();
        }
    }

    protected function addCentralTicketReply($centralTicketId, $data)
    {
        try {
            // Switch to central database context (MySQL)
            $originalConfig = config('database.default');
            config(['database.default' => 'mysql']);

            $data['support_ticket_id'] = $centralTicketId;
            $reply = SupportTicketReply::create($data);

            // Restore tenant database context
            config(['database.default' => $originalConfig]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to add central ticket reply: ' . $e->getMessage());
            return false;
        }
    }
}
