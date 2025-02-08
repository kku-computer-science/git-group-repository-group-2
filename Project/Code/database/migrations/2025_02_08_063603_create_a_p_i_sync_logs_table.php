<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAPISyncLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('api_sync_logs', function (Blueprint $table) {
        $table->id('logId'); // Primary Key
        $table->unsignedBigInteger('paperId'); // Foreign Key to Paper
        $table->unsignedBigInteger('sourceTypeId'); // Foreign Key to SourceType
        $table->unsignedBigInteger('sourceId'); // Foreign Key to Sourcepaper
        $table->string('syncStatus', 20);
        $table->text('errorMessage')->nullable();
        $table->timestamp('syncTime')->useCurrent();

        // Foreign Keys
        $table->foreign('paperId')->references('paperId')->on('papers')->onDelete('cascade'); // เปลี่ยนเป็น 'papers'
        $table->foreign('sourceTypeId')->references('sourceTypeId')->on('source_types')->onDelete('cascade'); // เปลี่ยนเป็น 'source_types'
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
        Schema::dropIfExists('a_p_i_sync_logs');
    }
}
