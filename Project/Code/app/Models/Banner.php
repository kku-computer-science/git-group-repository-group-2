<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // กำหนดให้สามารถกรอกข้อมูลได้จากฟอร์ม
    protected $fillable = ['image_path'];
}