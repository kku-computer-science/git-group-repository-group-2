<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('highlight_id');
            $table->string('image_path');
            $table->timestamps();

            // กำหนดความสัมพันธ์กับตาราง highlights
            $table->foreign('highlight_id')
                  ->references('id')
                  ->on('highlights')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
