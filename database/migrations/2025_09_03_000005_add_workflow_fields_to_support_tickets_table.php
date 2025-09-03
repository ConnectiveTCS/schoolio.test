<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->timestamp('first_response_at')->nullable()->after('resolved_at');
            $table->unsignedBigInteger('sla_policy_id')->nullable()->after('assigned_admin_id');
            $table->timestamp('sla_due_at')->nullable()->after('first_response_at');
            $table->enum('sla_status', ['on_track', 'warning', 'critical', 'breached'])->default('on_track')->after('sla_due_at');
            $table->timestamp('last_escalated_at')->nullable()->after('sla_status');
            $table->integer('escalation_level')->default(0)->after('last_escalated_at');

            $table->foreign('sla_policy_id')->references('id')->on('sla_policies')->onDelete('set null');
            $table->index(['sla_due_at', 'sla_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->dropForeign(['sla_policy_id']);
            $table->dropIndex(['sla_due_at', 'sla_status']);
            $table->dropColumn([
                'first_response_at',
                'sla_policy_id',
                'sla_due_at',
                'sla_status',
                'last_escalated_at',
                'escalation_level'
            ]);
        });
    }
};
