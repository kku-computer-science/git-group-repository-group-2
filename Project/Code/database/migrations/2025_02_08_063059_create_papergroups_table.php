<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papergroups', function (Blueprint $table) {
            $table->id('groupId'); // Primary Key
            $table->string('groupName_en', 100);
            $table->string('groupName_th', 100);
            $table->unsignedBigInteger('typeId'); // Foreign Key to GroupType
            $table->unsignedBigInteger('authorId'); // Foreign Key to Author
            $table->timestamps();

            // Foreign Keys
            $table->foreign('typeId')->references('typeId')->on('group_types')->onDelete('cascade');
            $table->foreign('authorId')->references('authorId')->on('authors')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papergroups');
    }
}
