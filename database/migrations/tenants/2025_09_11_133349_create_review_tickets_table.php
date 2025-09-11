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
        Schema::create('review_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('tenant_teachers')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('tenant_classes')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('tenant_students')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->json('questions')->nullable()->default(null);
            $table->text('comments')->nullable();
            $table->enum('status', ['pending', 'in_review', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_tickets');
    }
};
