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
        Schema::create('periodicals', function (Blueprint $table) {
            $table->id();
            $table->string('material_type');
            $table->string('title');
            $table->string('author');
            $table->string('image_location')->nullable();
            $table->string('language');
            $table->date('receive_date')->nullable();
            $table->string('publisher');
            $table->year('copyright');
            $table->integer('volume')->nullable();
            $table->integer('issue')->nullable();
            $table->integer('pages');
            $table->text('content')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_published');
            $table->boolean('available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodicals');
    }
};
