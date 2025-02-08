<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAPICredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('api_credentials', function (Blueprint $table) {
        $table->id('credentialId'); // Primary Key
        $table->unsignedBigInteger('sourceTypeId'); // Foreign Key to SourceType
        $table->timestamp('lastUpdated')->useCurrent();

        // Foreign Key
        $table->foreign('sourceTypeId')->references('sourceTypeId')->on('source_types')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('a_p_i_credentials');
    }
}
