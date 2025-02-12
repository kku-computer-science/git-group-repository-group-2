<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id('EduId'); // Primary Key
            $table->unsignedBigInteger('userId'); // Foreign Key to Users
            $table->string('year', 4);
            $table->string('degree', 50);
            $table->string('field_of_study', 100);
            $table->string('institution', 100);
            $table->timestamps();

            // Foreign Key
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
