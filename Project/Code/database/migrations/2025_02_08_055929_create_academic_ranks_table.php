<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_ranks', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('rank_name_en'); // ชื่อยศภาษาอังกฤษ
            $table->string('rank_name_th'); // ชื่อยศภาษาไทย
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
        Schema::dropIfExists('academic_ranks');
    }
}
