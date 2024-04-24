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
        Schema::create('lockers_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('locker_id')->references('id')->on('lockers');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamp('time_in')->useCurrent();
            $table->timestamp('time_out')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lockers_logs');
    }
};
