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
        // Drop the old attendance table with incorrect structure
        Schema::dropIfExists('attendance');

        // Create the new attendances table with correct structure
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_student_id');
            $table->unsignedBigInteger('tenant_class_id');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('marked_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tenant_student_id')->references('id')->on('tenant_students')->onDelete('cascade');
            $table->foreign('tenant_class_id')->references('id')->on('tenant_classes')->onDelete('cascade');
            $table->foreign('marked_by')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['tenant_student_id', 'tenant_class_id', 'date']);
            $table->index(['date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');

        // Recreate the old table structure if needed
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('class_id');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('recorded_by');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('tenant_students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('tenant_classes')->onDelete('cascade');
            $table->foreign('recorded_by')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['student_id', 'class_id', 'date']);
            $table->index(['date', 'status']);
        });
    }
};
