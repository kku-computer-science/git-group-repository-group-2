<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRank extends Model
{
    use HasFactory;
    // กำหนดฟิลด์ที่อนุญาตให้กรอกข้อมูล
    protected $fillable = ['rank_name_en', 'rank_name_th'];

    // ถ้าต้องการเชื่อมโยงกับ authors table
    public function authors()
    {
        return $this->hasMany(Author::class, 'rankId'); // 'rankId' คือตัวที่ใช้ใน authors table
    }
}
