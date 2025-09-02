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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->timestamp('read_at')->nullable();
            $table->boolean('sender_deleted')->default(false);
            $table->boolean('recipient_deleted')->default(false);
            $table->string('message_type')->default('personal'); // personal, school_general
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');

            $table->index(['sender_id', 'created_at']);
            $table->index(['recipient_id', 'created_at']);
            $table->index(['read_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
