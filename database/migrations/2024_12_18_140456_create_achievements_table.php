<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /***/
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('student_id'); // Foreign key
            $table->string('title'); // Title of the achievement
            $table->text('description')->nullable(); // Description (optional)
            $table->date('date_awarded'); // Date when the achievement was awarded
            $table->enum('type', ['Academic', 'Sports', 'Cultural', 'Other']); // Type of achievement
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraint
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
