<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userId');  // Primary Key
            $table->string('fname_en');
            $table->string('fname_th');
            $table->string('lname_en');
            $table->string('lname_th');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('picture')->nullable();
            $table->timestamps();  // Created at, Updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
