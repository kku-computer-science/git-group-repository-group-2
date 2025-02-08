<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->bigIncrements('paperId');  // เพิ่ม primary key
            $table->bigInteger('groupId')->unsigned();  // สร้าง foreign key กับ papergroup
            $table->bigInteger('sourceId')->unsigned();  // สร้าง foreign key กับ sourcepaper
            $table->text('paperName');
            $table->string('paperType', 50);
            $table->string('paperSubType', 50);
            $table->integer('paperYear');
            $table->string('paperVolume', 50);
            $table->integer('paperCite');
            $table->string('paperPage', 50);
            $table->string('paperDoi', 255)->nullable();
            $table->timestamps();
    
            // กำหนด foreign key
            $table->foreign('groupId')->references('groupId')->on('papergroups')->onDelete('cascade');
            $table->foreign('sourceId')->references('sourceId')->on('sourcepapers')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papers');
    }
}
