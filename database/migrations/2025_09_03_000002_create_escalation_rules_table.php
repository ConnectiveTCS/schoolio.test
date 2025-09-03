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
        Schema::create('escalation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->integer('priority_order')->default(0);

            // Trigger conditions
            $table->json('trigger_statuses')->nullable(); // statuses that trigger escalation
            $table->json('trigger_priorities')->nullable(); // priorities that trigger escalation
            $table->integer('hours_threshold'); // hours before escalation

            // Escalation actions
            $table->enum('escalation_type', ['priority_bump', 'reassign', 'notify', 'status_change'])->default('priority_bump');
            $table->string('new_priority')->nullable(); // for priority_bump
            $table->unsignedBigInteger('escalate_to_admin_id')->nullable(); // for reassign
            $table->json('notify_admin_ids')->nullable(); // for notify
            $table->string('new_status')->nullable(); // for status_change

            $table->timestamps();

            $table->foreign('escalate_to_admin_id')->references('id')->on('central_admins')->onDelete('set null');
            $table->index(['is_active', 'priority_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalation_rules');
    }
};
