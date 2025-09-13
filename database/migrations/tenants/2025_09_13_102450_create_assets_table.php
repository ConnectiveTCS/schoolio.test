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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->string('asset_model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('vendor')->nullable();
            $table->string('warranty_period')->nullable();
            $table->string('warranty_expiry_date')->nullable();
            $table->string('asset_image')->nullable();
            $table->json('additional_images')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('serial_number')->unique()->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->string('condition')->default('good');
            $table->text('notes')->nullable();
            $table->string('location')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
