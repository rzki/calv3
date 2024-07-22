<?php

use App\Models\DeviceName;
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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->uuid('logId');
            $table->foreignIdFor(DeviceName::class, 'device_name_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('tanggal_mulai_pinjam')->nullable();
            $table->date('tanggal_selesai_pinjam')->nullable();
            $table->string('lokasi_pinjam')->nullable();
            $table->string('pic_pinjam')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook');
    }
};
