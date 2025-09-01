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
        Schema::create('impersonation_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('central_admin_id');
            $table->string('tenant_id'); // Changed from tenant_domain to tenant_id
            $table->unsignedBigInteger('user_id')->nullable(); // Made nullable and added for future use
            $table->string('token', 255)->unique();
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->foreign('central_admin_id')->references('id')->on('central_admins')->onDelete('cascade');
            $table->index(['token', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impersonation_tokens');
    }
};
