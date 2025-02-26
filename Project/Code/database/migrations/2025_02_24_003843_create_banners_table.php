<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('image_path_th')->nullable();
        $table->string('image_path_en')->nullable();
        $table->string('image_path_zh')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('banners');
}
}
