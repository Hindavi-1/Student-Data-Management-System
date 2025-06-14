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
        Schema::create('internships', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('student_id'); // Foreign key to the users table
            $table->string('student_name'); // Redundant but useful for display
            $table->string('email');
            $table->string('company_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'completed', 'canceled'])->default('active'); // Internship status
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inernships');
    }
};
