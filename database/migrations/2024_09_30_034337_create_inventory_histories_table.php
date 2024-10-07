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
        Schema::create('inventory_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('historyId');
            $table->foreignId('inv_id')->constrained('inventories', 'id', 'inv_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->string('activity');
            $table->tinyText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_histories');
    }
};
