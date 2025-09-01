<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            // your custom columns may go here
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->longText('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->string('plan')->nullable()->default('basic');
            $table->date('trial_ends_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('language')->nullable();
            $table->string('school_type')->nullable()->default('primary');
            $table->string('timezone')->nullable()->default('UTC');
            $table->json('color_scheme')->nullable();

            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
