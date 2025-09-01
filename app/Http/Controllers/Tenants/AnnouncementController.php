<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AnnouncementController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of announcements for management.
     */
    public function index()
    {
        $this->authorize('manage announcements');

        $announcements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('tenants.announcements.index', compact('announcements'));
    }

    /**
     * Display announcements for the current user based on their role.
     */
    public function userAnnouncements()
    {
        $user = Auth::user();
        $userRoles = $user->getRoleNames()->toArray();

        $announcements = Announcement::active()
            ->forRoles($userRoles)
            ->with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tenants.announcements.user-announcements', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        $this->authorize('create announcements');

        $availableRoles = [
            'tenant_admin' => 'Tenant Admin',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'parent' => 'Parent',
        ];

        return view('tenants.announcements.create', compact('availableRoles'));
    }

    /**
     * Store a newly created announcement in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create announcements');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'required|string|in:tenant_admin,teacher,student,parent',
            'expires_at' => 'nullable|date|after:now',
            'is_active' => 'boolean',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
        ]);

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . uniqid() . '_' . $originalName;
                $tenantId = tenant('id');
                $path = $file->storeAs("tenant_{$tenantId}/announcements", $filename, 'public');

                $attachments[] = [
                    'original_name' => $originalName,
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'target_roles' => $validated['target_roles'],
            'created_by' => Auth::id(),
            'expires_at' => $validated['expires_at'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'attachments' => $attachments,
        ]);

        return redirect()->route('tenant.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        // Check if user can view this announcement
        if (!$announcement->isVisibleToUser(Auth::user()) && !Auth::user()->can('manage announcements')) {
            abort(403, 'You do not have permission to view this announcement.');
        }

        return view('tenants.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit(Announcement $announcement)
    {
        $this->authorize('edit announcements');

        $availableRoles = [
            'tenant_admin' => 'Tenant Admin',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'parent' => 'Parent',
        ];

        return view('tenants.announcements.edit', compact('announcement', 'availableRoles'));
    }

    /**
     * Update the specified announcement in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('edit announcements');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'target_roles' => 'required|array|min:1',
            'target_roles.*' => 'required|string|in:tenant_admin,teacher,student,parent',
            'expires_at' => 'nullable|date|after:now',
            'is_active' => 'boolean',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,gif,zip,rar',
            'remove_attachments' => 'nullable|array',
            'remove_attachments.*' => 'string',
        ]);

        // Handle file removals
        $currentAttachments = $announcement->attachments ?? [];
        if (!empty($validated['remove_attachments'])) {
            foreach ($validated['remove_attachments'] as $filenameToRemove) {
                // Find and remove file from storage
                $attachmentToRemove = collect($currentAttachments)->firstWhere('filename', $filenameToRemove);
                if ($attachmentToRemove && isset($attachmentToRemove['path'])) {
                    Storage::disk('public')->delete($attachmentToRemove['path']);
                }

                // Remove from attachments array
                $currentAttachments = array_filter($currentAttachments, function ($attachment) use ($filenameToRemove) {
                    return $attachment['filename'] !== $filenameToRemove;
                });
            }
        }

        // Handle new file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . uniqid() . '_' . $originalName;
                $tenantId = tenant('id');
                $path = $file->storeAs("tenant_{$tenantId}/announcements", $filename, 'public');

                $currentAttachments[] = [
                    'original_name' => $originalName,
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        $announcement->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'target_roles' => $validated['target_roles'],
            'expires_at' => $validated['expires_at'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'attachments' => array_values($currentAttachments), // Re-index array
        ]);

        return redirect()->route('tenant.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete announcements');

        // Delete all attachment files
        if ($announcement->hasAttachments()) {
            foreach ($announcement->attachments as $attachment) {
                Storage::disk('tenant')->delete('announcements/' . $attachment['filename']);
            }
        }

        $announcement->delete();

        return redirect()->route('tenant.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Download an attachment.
     */
    public function downloadAttachment(Announcement $announcement, string $filename)
    {
        // Check if user can view this announcement
        if (!$announcement->isVisibleToUser(Auth::user()) && !Auth::user()->can('manage announcements')) {
            abort(403, 'You do not have permission to download this file.');
        }

        // Find the attachment in the announcement
        $attachment = collect($announcement->attachments)->firstWhere('filename', $filename);

        if (!$attachment) {
            abort(404, 'File not found.');
        }

        $filePath = $attachment['path'];

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download(
            Storage::disk('public')->path($filePath),
            $attachment['original_name']
        );
    }

    /**
     * Toggle the active status of an announcement.
     */
    public function toggleStatus(Announcement $announcement)
    {
        $this->authorize('edit announcements');

        $announcement->update([
            'is_active' => !$announcement->is_active
        ]);

        $status = $announcement->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Announcement {$status} successfully.");
    }
}
