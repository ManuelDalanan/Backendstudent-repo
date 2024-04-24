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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('call_number');
            $table->string('isbn')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('image_location')->nullable();
            $table->string('language');
            $table->foreignId('location_id')->references('id')->on('locations');
            $table->string('publisher');
            $table->year('copyright');
            $table->integer('volume')->nullable();
            $table->string('edition')->nullable();
            $table->integer('pages');
            $table->date('purchase_date')->nullable();
            $table->text('content')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_published');
            $table->boolean('main_copy')->default(true);
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
        Schema::dropIfExists('books');
    }
};
