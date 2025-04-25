<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFavoriteToHighlightsTable extends Migration
{
    public function up()
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->boolean('is_favorite')->default(false)->after('thumbnail');
        });
    }

    public function down()
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn('is_favorite');
        });
    }
}
