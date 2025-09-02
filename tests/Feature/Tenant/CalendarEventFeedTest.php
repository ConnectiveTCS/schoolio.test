<?php

use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

it('returns only published & role-visible events in feed', function () {
    $teacherRole = Role::create(['name' => 'teacher']);
    $studentRole = Role::create(['name' => 'student']);
    $user = User::factory()->create();
    $user->assignRole($teacherRole);

    CalendarEvent::factory()->create(['title' => 'Visible Global', 'target_roles' => null, 'start_at' => now()->addDay(), 'is_published' => true]);
    CalendarEvent::factory()->create(['title' => 'Teacher Only', 'target_roles' => ['teacher'], 'start_at' => now()->addDays(2), 'is_published' => true]);
    CalendarEvent::factory()->create(['title' => 'Student Only', 'target_roles' => ['student'], 'start_at' => now()->addDays(3), 'is_published' => true]);
    CalendarEvent::factory()->create(['title' => 'Draft Hidden', 'target_roles' => null, 'start_at' => now()->addDays(4), 'is_published' => false]);

    $response = $this->actingAs($user)->get('/testing/calendar-events-feed');
    $response->assertOk();
    $titles = collect($response->json('data'))->pluck('title');
    expect($titles)->toContain('Visible Global')->toContain('Teacher Only')->not->toContain('Student Only')->not->toContain('Draft Hidden');
});

it('supports filtering by type in feed', function () {
    $role = Role::create(['name' => 'teacher']);
    $user = User::factory()->create();
    $user->assignRole($role);

    CalendarEvent::factory()->create(['title' => 'Exam Event', 'type' => 'exam', 'start_at' => now()->addDay(), 'is_published' => true]);
    CalendarEvent::factory()->create(['title' => 'Holiday Event', 'type' => 'holiday', 'start_at' => now()->addDays(2), 'is_published' => true]);

    $response = $this->actingAs($user)->get('/testing/calendar-events-feed?type=exam');
    $titles = collect($response->json('data'))->pluck('title');
    expect($titles)->toContain('Exam Event')->not->toContain('Holiday Event');
});
