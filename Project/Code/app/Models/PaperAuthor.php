<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperAuthor extends Model
{
    use HasFactory;
    protected $table = 'paper_authors'; // ตั้งชื่อให้ตรงกับตารางในฐานข้อมูล

    // ความสัมพันธ์กับ Paper
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paperId');
    }

    // ความสัมพันธ์กับ Author
    public function author()
    {
        return $this->belongsTo(Author::class, 'authorId');
    }
}
