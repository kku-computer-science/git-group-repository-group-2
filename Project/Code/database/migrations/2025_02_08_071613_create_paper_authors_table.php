<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('paper_authors', function (Blueprint $table) {
        $table->bigIncrements('paperAuthorId'); // Primary Key
        $table->unsignedBigInteger('paperId'); // Foreign Key to Paper
        $table->unsignedBigInteger('authorId'); // Foreign Key to Author

        // Foreign Keys
        $table->foreign('paperId')->references('paperId')->on('papers')->onDelete('cascade');
        $table->foreign('authorId')->references('authorId')->on('authors')->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper_authors');
    }
}
