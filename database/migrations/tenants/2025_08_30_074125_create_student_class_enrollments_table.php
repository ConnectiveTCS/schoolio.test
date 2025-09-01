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
        Schema::create('student_class_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_student_id')->constrained('tenant_students')->onDelete('cascade');
            $table->foreignId('tenant_class_id')->constrained('tenant_classes')->onDelete('cascade');
            $table->date('enrolled_at')->default(now());
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Ensure a student can't be enrolled in the same class twice
            $table->unique(['tenant_student_id', 'tenant_class_id'], 'enrollments_student_class_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_class_enrollments');
    }
};
