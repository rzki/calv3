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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->uuid('inventoryId');
            $table->foreignId('device_name')->nullable()->constrained('device_names', 'id', 'device_name')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('brand');
            $table->string('type');
            $table->string('sn');
            $table->year('procurement_year');
            $table->string('inv_number')->nullable()->unique();
            $table->date('last_calibrated_date')->nullable();
            $table->date('next_calibrated_date')->nullable();
            $table->string('pic')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('rs_id')->nullable()->constrained('hospitals', 'id', 'rs_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
