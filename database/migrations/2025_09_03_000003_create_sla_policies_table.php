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
        Schema::create('sla_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->integer('priority_order')->default(0);

            // SLA conditions
            $table->json('applies_to_priorities')->nullable(); // array of priorities
            $table->json('applies_to_categories')->nullable(); // array of categories
            $table->json('applies_to_tenant_ids')->nullable(); // array of tenant IDs

            // SLA timelines (in hours)
            $table->integer('first_response_hours')->nullable(); // time to first response
            $table->integer('resolution_hours')->nullable(); // time to resolution
            $table->integer('escalation_hours')->nullable(); // time before escalation

            // Warning thresholds (percentage of SLA time)
            $table->integer('warning_threshold_percent')->default(75); // warn at 75% of SLA time
            $table->integer('critical_threshold_percent')->default(90); // critical at 90% of SLA time

            // Business hours
            $table->json('business_hours')->nullable(); // {"start": "09:00", "end": "17:00", "days": [1,2,3,4,5], "timezone": "UTC"}
            $table->boolean('exclude_weekends')->default(true);
            $table->boolean('exclude_holidays')->default(true);

            $table->timestamps();

            $table->index(['is_active', 'priority_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sla_policies');
    }
};
