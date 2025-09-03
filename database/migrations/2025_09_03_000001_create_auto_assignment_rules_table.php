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
        Schema::create('auto_assignment_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->integer('priority_order')->default(0);

            // Conditions
            $table->json('categories')->nullable(); // array of categories
            $table->json('priorities')->nullable(); // array of priorities
            $table->json('tenant_ids')->nullable(); // array of tenant IDs
            $table->json('keywords')->nullable(); // array of keywords to match in title/description

            // Assignment target
            $table->unsignedBigInteger('assigned_admin_id');
            $table->enum('assignment_strategy', ['round_robin', 'least_loaded', 'specific_admin'])->default('specific_admin');

            // Conditions for time-based rules
            $table->json('business_hours')->nullable(); // {"start": "09:00", "end": "17:00", "days": [1,2,3,4,5]}

            $table->timestamps();

            $table->foreign('assigned_admin_id')->references('id')->on('central_admins')->onDelete('cascade');
            $table->index(['is_active', 'priority_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_assignment_rules');
    }
};
