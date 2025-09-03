<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AutoAssignmentRule;
use App\Models\EscalationRule;
use App\Models\SlaPolicy;
use App\Models\CentralAdmin;

class WorkflowAutomationSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first admin for assignment rules
        $firstAdmin = CentralAdmin::first();

        if (!$firstAdmin) {
            $this->command->warn('No central admin found. Skipping workflow automation seeder.');
            return;
        }

        // Create Auto Assignment Rules
        AutoAssignmentRule::create([
            'name' => 'High Priority Technical Issues',
            'is_active' => true,
            'priority_order' => 1,
            'categories' => ['technical'],
            'priorities' => ['high', 'critical'],
            'assigned_admin_id' => $firstAdmin->id,
            'assignment_strategy' => 'specific_admin',
        ]);

        AutoAssignmentRule::create([
            'name' => 'Billing Issues',
            'is_active' => true,
            'priority_order' => 2,
            'categories' => ['billing'],
            'assigned_admin_id' => $firstAdmin->id,
            'assignment_strategy' => 'specific_admin',
        ]);

        AutoAssignmentRule::create([
            'name' => 'General Issues (Business Hours)',
            'is_active' => true,
            'priority_order' => 3,
            'categories' => ['general'],
            'assigned_admin_id' => $firstAdmin->id,
            'assignment_strategy' => 'least_loaded',
            'business_hours' => [
                'start' => '09:00',
                'end' => '17:00',
                'days' => [1, 2, 3, 4, 5], // Monday to Friday
            ],
        ]);

        // Create Escalation Rules
        EscalationRule::create([
            'name' => 'Critical Priority Escalation',
            'is_active' => true,
            'priority_order' => 1,
            'trigger_statuses' => ['open', 'in_progress'],
            'trigger_priorities' => ['critical'],
            'hours_threshold' => 2, // 2 hours
            'escalation_type' => 'notify',
            'notify_admin_ids' => [$firstAdmin->id],
        ]);

        EscalationRule::create([
            'name' => 'High Priority Escalation',
            'is_active' => true,
            'priority_order' => 2,
            'trigger_statuses' => ['open', 'in_progress'],
            'trigger_priorities' => ['high'],
            'hours_threshold' => 4, // 4 hours
            'escalation_type' => 'priority_bump',
            'new_priority' => 'critical',
        ]);

        EscalationRule::create([
            'name' => 'Unassigned Ticket Escalation',
            'is_active' => true,
            'priority_order' => 3,
            'trigger_statuses' => ['open'],
            'hours_threshold' => 1, // 1 hour
            'escalation_type' => 'reassign',
            'escalate_to_admin_id' => $firstAdmin->id,
        ]);

        // Create SLA Policies
        SlaPolicy::create([
            'name' => 'Critical Issues SLA',
            'is_active' => true,
            'priority_order' => 1,
            'applies_to_priorities' => ['critical'],
            'first_response_hours' => 1,
            'resolution_hours' => 4,
            'escalation_hours' => 2,
            'warning_threshold_percent' => 75,
            'critical_threshold_percent' => 90,
            'business_hours' => [
                'start' => '00:00',
                'end' => '23:59',
                'days' => [0, 1, 2, 3, 4, 5, 6], // 24/7
                'timezone' => 'UTC'
            ],
            'exclude_weekends' => false,
            'exclude_holidays' => false,
        ]);

        SlaPolicy::create([
            'name' => 'High Priority SLA',
            'is_active' => true,
            'priority_order' => 2,
            'applies_to_priorities' => ['high'],
            'first_response_hours' => 2,
            'resolution_hours' => 8,
            'escalation_hours' => 4,
            'warning_threshold_percent' => 75,
            'critical_threshold_percent' => 90,
            'business_hours' => [
                'start' => '09:00',
                'end' => '17:00',
                'days' => [1, 2, 3, 4, 5],
                'timezone' => 'UTC'
            ],
            'exclude_weekends' => true,
            'exclude_holidays' => true,
        ]);

        SlaPolicy::create([
            'name' => 'Standard SLA',
            'is_active' => true,
            'priority_order' => 3,
            'applies_to_priorities' => ['medium', 'low'],
            'first_response_hours' => 4,
            'resolution_hours' => 24,
            'escalation_hours' => 16,
            'warning_threshold_percent' => 75,
            'critical_threshold_percent' => 90,
            'business_hours' => [
                'start' => '09:00',
                'end' => '17:00',
                'days' => [1, 2, 3, 4, 5],
                'timezone' => 'UTC'
            ],
            'exclude_weekends' => true,
            'exclude_holidays' => true,
        ]);

        $this->command->info('Workflow automation rules and policies created successfully!');
    }
}
