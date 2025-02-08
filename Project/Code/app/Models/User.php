<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';  // กำหนดชื่อ table
    protected $primaryKey = 'userId';  // กำหนด primary key (ไม่ใช้ default 'id')
    // กำหนด relationship ที่เชื่อมกับ Author
    public function author() {
        return $this->hasOne(Author::class, 'userId');  // เชื่อมกับ Author โดยใช้ userId
    }
    // ความสัมพันธ์กับ Education
    public function education() {
        return $this->hasMany(Education::class, 'userId');  // เชื่อมกับ Education โดยใช้ userId
    }
}
