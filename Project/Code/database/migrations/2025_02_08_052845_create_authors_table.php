<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id('authorId');  // Primary Key
            $table->unsignedBigInteger('userId');  // ให้ใช้ชื่อคอลัมน์ตรงกับใน users table
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');  // เชื่อมกับ userId ใน users
            $table->foreignId('titleId')->constrained('academic_titles');  // เชื่อมกับ academic_titles
            $table->foreignId('rankId')->constrained('academic_ranks');  // เชื่อมกับ academic_ranks
            $table->string('orcid')->nullable();  // ORCID
            $table->string('scholarId')->nullable();  // Google Scholar ID
            $table->string('author_fname_en');
            $table->string('author_fname_th');
            $table->string('author_lname_en');
            $table->string('author_lname_th');
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
        Schema::dropIfExists('authors');
    }
}
