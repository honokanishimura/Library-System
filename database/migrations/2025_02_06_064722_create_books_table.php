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
            $table->string('title');
            $table->string('author_name');
            $table->string('isbn')->unique();
            $table->string('image')->nullable();
            $table->boolean('lended')->default(false);
            $table->unsignedBigInteger('genre_id');
            $table->timestamps();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->date('returned_at')->nullable();
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
