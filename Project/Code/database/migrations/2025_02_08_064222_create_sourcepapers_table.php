<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcepapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sourcepapers', function (Blueprint $table) {
            $table->bigIncrements('sourceId');
            $table->string('sourceName', 100);
            $table->bigInteger('sourceTypeId')->unsigned();
            $table->string('sourceURL', 255);
            $table->foreign('sourceTypeId')->references('sourceTypeId')->on('source_types'); // เปลี่ยนจาก 'id' เป็น 'sourceTypeId'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sourcepapers');
    }
}
