<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicTitle extends Model
{
    use HasFactory;
    protected $table = 'academic_titles'; // กำหนดชื่อ table
    protected $primaryKey = 'id'; // ระบุ Primary Key
    public $timestamps = true; // ใช้ timestamps (created_at, updated_at)

    protected $fillable = [
        'title_en',
        'title_th',
    ];

    // ความสัมพันธ์กับ Authors (1 Academic Title มีหลาย Authors)
    public function authors()
    {
        return $this->hasMany(Author::class, 'titleId');
    }
}
