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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('deviceId');
            $table->foreignId('name_id')->nullable()->constrained('device_names', 'id', 'name_id')->nullOnDelete()->cascadeOnUpdate();
            $table->string('inv_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('location')->nullable();
            $table->year('procurement_year')->nullable();
            $table->string('pic')->nullable();
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals', 'id', 'hospital_id')->nullOnDelete()->cascadeOnUpdate();
            $table->date('calibration_date')->nullable();
            $table->date('next_calibration_date')->nullable();
            $table->string('certif_no')->nullable();
            $table->text('certif_file')->nullable();
            $table->text('barcode')->nullable();
            $table->string('result')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id', 'user_id')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
