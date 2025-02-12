<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    protected $table = 'papers';  // กำหนดชื่อของตารางที่ใช้ในฐานข้อมูล
    protected $primaryKey = 'paperId';  // กำหนด primary key
    public $timestamps = false;  // ถ้าไม่ใช้ timestamps
    protected $fillable = [
        'paperId', 'groupId', 'sourceId', 'paperName', 'paperType',
        'paperSubType', 'paperYear', 'paperVolume', 'paperCite', 'paperPage', 'paperDoi'
    ];

    // ความสัมพันธ์กับตารางอื่น ๆ เช่น
    public function papergroup()
    {
        return $this->belongsTo(Papergroup::class, 'groupId');
    }

    public function sourcepaper()
    {
        return $this->belongsTo(Sourcepaper::class, 'sourceId');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'paper_authors', 'paperId', 'authorId');
    }
}
