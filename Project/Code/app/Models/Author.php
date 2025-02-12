<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'authors';  // กำหนดชื่อ table

    protected $primaryKey = 'authorId';  // กำหนด primary key

    // ความสัมพันธ์กับ User
    public function user() {
        return $this->belongsTo(User::class, 'userId');  // เชื่อมกับ User โดยใช้ userId
    }

    // ความสัมพันธ์กับ AcademicTitle
    public function academicTitle() {
        return $this->belongsTo(AcademicTitle::class, 'titleId');  // เชื่อมกับ AcademicTitle
    }

    // ความสัมพันธ์กับ AcademicRank
    public function academicRank() {
        return $this->belongsTo(AcademicRank::class, 'rankId');  // เชื่อมกับ AcademicRank
    }

    // ความสัมพันธ์กับ Papergroup
    public function papergroups() {
        return $this->hasMany(Papergroup::class, 'authorId');  // เชื่อมกับ Papergroup
    }

    // ความสัมพันธ์กับ PaperAuthors
    public function paperAuthors() {
        return $this->hasMany(PaperAuthors::class, 'authorId');  // เชื่อมกับ PaperAuthors
    }
}
