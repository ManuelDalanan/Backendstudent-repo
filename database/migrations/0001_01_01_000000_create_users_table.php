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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('course', 10)->unique();
            $table->string('department', 50);
        });

        Schema::create('patrons', function (Blueprint $table) {
            $table->id();
            $table->string('patron')->unique();
            $table->decimal('fine');
            $table->text('description');
            $table->timestamps(1);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->enum('role', ['superadmin', 'admin', 'staff', 'user'])->default('user');
            $table->foreignId('patron_id')->references('id')->on('patrons');
            $table->string('password');
            $table->rememberToken();

            // details
            $table->string('first_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('last_name', 30);
            $table->string('ext_name', 10)->nullable();
            $table->string('course_id', 10)->nullable(); // students
            $table->string('department', 50)->nullable(); // staffs
            $table->string('position', 50)->nullable(); // staffs
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
