<?php

use App\Models\User;
use App\Models\DeviceName;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->uuid('logId');
            $table->foreignId('device_name_id')->nullable()->constrained('device_names', 'id', 'device_name_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('submitter_id')->nullable()->constrained('users', 'id', 'submitter_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('mulai_pinjam')->nullable();
            $table->date('selesai_pinjam')->nullable();
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
