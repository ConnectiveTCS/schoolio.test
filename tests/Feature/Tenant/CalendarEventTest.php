<?php

use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

it('creates a basic calendar event and retrieves via scopes', function () {
    // Arrange roles & user
    $teacherRole = Role::create(['name' => 'teacher']);
    $user = User::factory()->create();
    $user->assignRole($teacherRole);

    // Global event (no target_roles)
    $event1 = CalendarEvent::create([
        'title' => 'General Assembly',
        'type' => 'event',
        'start_at' => now()->addDay(),
        'end_at' => null,
        'all_day' => true,
        'is_published' => true,
        'created_by' => $user->id,
        'target_roles' => null,
    ]);

    // Targeted event
    $event2 = CalendarEvent::create([
        'title' => 'Midterm Exam',
        'type' => 'exam',
        'start_at' => now()->addDays(2),
        'end_at' => now()->addDays(2),
        'all_day' => true,
        'is_published' => true,
        'created_by' => $user->id,
        'target_roles' => ['teacher'],
    ]);

    // Unpublished event (should not appear)
    CalendarEvent::create([
        'title' => 'Draft Holiday',
        'type' => 'holiday',
        'start_at' => now()->addDays(3),
        'end_at' => null,
        'all_day' => true,
        'is_published' => false,
        'created_by' => $user->id,
        'target_roles' => null,
    ]);

    // Act
    $visible = CalendarEvent::published()->upcoming()->get();
    $roleFiltered = CalendarEvent::published()->forRoles($user->getRoleNames()->toArray())->get();

    // Assert
    expect($visible->pluck('id'))
        ->toContain($event1->id)
        ->toContain($event2->id);

    expect($roleFiltered->pluck('id'))
        ->toContain($event1->id) // global event
        ->toContain($event2->id); // targeted teacher event
});
