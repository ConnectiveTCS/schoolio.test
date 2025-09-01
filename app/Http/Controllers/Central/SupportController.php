<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use App\Models\CentralAdmin;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::with(['tenant', 'assignedAdmin', 'replies']);

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

        // Filter by assigned admin
        if ($request->filled('assigned_admin')) {
            $query->where('assigned_admin_id', $request->assigned_admin);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ticket_number', 'like', "%{$search}%");
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);
        $admins = CentralAdmin::all();
        $tenants = Tenant::all();

        return view('central.support.index', compact('tickets', 'admins', 'tenants'));
    }

    public function show(SupportTicket $ticket)
    {
        $ticket->load(['tenant', 'assignedAdmin', 'replies']);
        $admins = CentralAdmin::all();

        return view('central.support.show', compact('ticket', 'admins'));
    }

    public function assign(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'assigned_admin_id' => 'required|exists:central_admins,id'
        ]);

        $ticket->update([
            'assigned_admin_id' => $request->assigned_admin_id,
            'status' => 'in_progress'
        ]);

        // Add internal note about assignment
        $admin = Auth::guard('central_admin')->user();
        $assignedAdmin = CentralAdmin::find($request->assigned_admin_id);

        SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'message' => "Ticket assigned to {$assignedAdmin->name} by {$admin->name}",
            'sender_type' => 'central_admin',
            'sender_details' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
            'is_internal' => true,
        ]);

        return redirect()->back()->with('success', 'Ticket assigned successfully.');
    }

    public function updateStatus(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'resolution_notes' => 'required_if:status,resolved,closed'
        ]);

        $updateData = ['status' => $request->status];

        if (in_array($request->status, ['resolved', 'closed'])) {
            $updateData['resolved_at'] = now();
            $updateData['resolution_notes'] = $request->resolution_notes;
        }

        $ticket->update($updateData);

        // Update tenant-side ticket status too
        $this->syncTicketStatusToTenant($ticket);

        // Add internal note about status change
        $admin = Auth::guard('central_admin')->user();
        SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'message' => "Status changed to {$request->status}" .
                ($request->resolution_notes ? "\n\nResolution Notes: {$request->resolution_notes}" : ''),
            'sender_type' => 'central_admin',
            'sender_details' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
            'is_internal' => true,
        ]);

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
            'is_internal' => 'boolean',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        $admin = Auth::guard('central_admin')->user();

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                try {
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '_' . $originalName;

                    // Ensure the directory exists
                    $directory = "central/support_tickets";
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
                        Log::error('Failed to store central reply attachment', ['filename' => $filename]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error uploading central reply attachment', ['error' => $e->getMessage(), 'filename' => $originalName]);
                    return back()->with('error', 'Failed to upload attachment: ' . $originalName);
                }
            }
        }

        SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'message' => $request->message,
            'attachments' => $attachments,
            'sender_type' => 'central_admin',
            'sender_details' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
            'is_internal' => $request->boolean('is_internal', false),
        ]);

        return redirect()->back()->with('success', 'Reply added successfully.');
    }

    protected function syncTicketStatusToTenant(SupportTicket $ticket)
    {
        try {
            $tenant = Tenant::find($ticket->tenant_id);
            if ($tenant) {
                tenancy()->initialize($tenant);

                $tenantTicket = \App\Models\TenantSupportTicket::where('central_ticket_id', $ticket->id)->first();
                if ($tenantTicket) {
                    $tenantTicket->update([
                        'status' => $ticket->status,
                        'resolved_at' => $ticket->resolved_at,
                    ]);
                }

                tenancy()->end();
            }
        } catch (\Exception $e) {
            Log::error('Failed to sync ticket status to tenant: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        $stats = [
            'total_tickets' => SupportTicket::count(),
            'open_tickets' => SupportTicket::where('status', 'open')->count(),
            'in_progress_tickets' => SupportTicket::where('status', 'in_progress')->count(),
            'resolved_tickets' => SupportTicket::where('status', 'resolved')->count(),
            'high_priority_tickets' => SupportTicket::whereIn('priority', ['high', 'critical'])->whereIn('status', ['open', 'in_progress'])->count(),
        ];

        $recent_tickets = SupportTicket::with(['tenant', 'assignedAdmin'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('central.support.dashboard', compact('stats', 'recent_tickets'));
    }

    public function downloadAttachment(SupportTicket $ticket, $filename)
    {
        // URL decode the filename in case it contains special characters
        $filename = urldecode($filename);

        Log::info('Download request (central)', [
            'ticket_id' => $ticket->id,
            'filename' => $filename,
            'ticket_attachments_count' => count($ticket->attachments ?? []),
            'replies_count' => $ticket->replies->count()
        ]);

        $tenantId = $ticket->tenant_id; // needed to derive tenant storage path

        $resolvePath = function (string $relative, ?int $tenantId) {
            // Possible locations (ordered)
            $paths = [];
            if ($tenantId) {
                $paths[] = storage_path("tenant{$tenantId}/app/public/" . $relative); // tenant scoped (stancl/tenancy)
            }
            $paths[] = storage_path('app/public/' . $relative); // central fallback
            foreach ($paths as $p) {
                if (file_exists($p)) {
                    return [$p, $paths];
                }
            }
            return [null, $paths];
        };

        // Ticket level attachments
        if ($ticket->attachments) {
            foreach ($ticket->attachments as $attachment) {
                if (($attachment['filename'] ?? null) === $filename) {
                    [$foundPath, $checked] = $resolvePath($attachment['path'], $tenantId);
                    Log::info('Attachment lookup (ticket)', [
                        'relative' => $attachment['path'],
                        'checked_paths' => $checked,
                        'found' => $foundPath !== null
                    ]);
                    if ($foundPath) {
                        return response()->download($foundPath, $attachment['original_name']);
                    }
                }
            }
        }

        // Reply attachments
        foreach ($ticket->replies as $reply) {
            if ($reply->attachments) {
                foreach ($reply->attachments as $attachment) {
                    if (($attachment['filename'] ?? null) === $filename) {
                        [$foundPath, $checked] = $resolvePath($attachment['path'], $tenantId);
                        Log::info('Attachment lookup (reply)', [
                            'reply_id' => $reply->id,
                            'relative' => $attachment['path'],
                            'checked_paths' => $checked,
                            'found' => $foundPath !== null
                        ]);
                        if ($foundPath) {
                            return response()->download($foundPath, $attachment['original_name']);
                        }
                    }
                }
            }
        }

        Log::warning('Attachment not found', ['ticket_id' => $ticket->id, 'filename' => $filename]);
        abort(404, 'Attachment not found.');
    }
}
