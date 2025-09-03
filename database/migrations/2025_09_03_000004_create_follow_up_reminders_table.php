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
        Schema::create('follow_up_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_ticket_id');
            $table->unsignedBigInteger('admin_id');
            $table->enum('reminder_type', ['follow_up', 'escalation', 'sla_warning', 'custom'])->default('follow_up');
            $table->timestamp('scheduled_at');
            $table->timestamp('sent_at')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->text('message')->nullable();
            $table->json('metadata')->nullable(); // additional data for the reminder

            $table->timestamps();

            $table->foreign('support_ticket_id')->references('id')->on('support_tickets')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('central_admins')->onDelete('cascade');
            $table->index(['scheduled_at', 'is_sent']);
            $table->index('support_ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_up_reminders');
    }
};
