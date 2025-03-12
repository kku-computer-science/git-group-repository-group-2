<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            // ลบ 'after' เพราะหากไม่มีคอลัมน์ 'program_name_th' จะทำให้เกิดข้อผิดพลาด
            $table->string('program_name_cn')->nullable();
        });
    }

    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('program_name_cn'); // ลบคอลัมน์ program_name_cn
        });
    }
};
