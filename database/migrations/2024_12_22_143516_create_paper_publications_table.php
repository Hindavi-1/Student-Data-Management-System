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
        Schema::create('paper_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for users table
            $table->string('title');
            $table->string('authors');
            $table->text('abstract')->nullable();
            $table->string('journal_name');
            $table->string('publisher')->nullable();
            $table->string('doi')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('document_path')->nullable(); // Path for uploaded document
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paper_publications');
    }
};
