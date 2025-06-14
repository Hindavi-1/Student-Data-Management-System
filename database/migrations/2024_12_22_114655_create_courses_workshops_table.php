<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('courses_workshops', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Foreign key for user
        $table->string('title'); // Course or Workshop title
        $table->string('organizer'); // Organizer/Institution
        $table->date('start_date'); // Start date
        $table->date('end_date')->nullable(); // End date
        $table->enum('type', ['Course', 'Workshop'])->default('Course'); // Type
        $table->enum('mode', ['Online', 'Offline', 'Hybrid'])->default('Online'); // Mode of attendance
        $table->text('skills_acquired')->nullable(); // Skills acquired
        $table->string('certificate')->nullable(); // Path to uploaded certificate
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_workshops');
    }
};
