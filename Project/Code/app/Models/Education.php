<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';
    protected $primaryKey = 'EduId';
    public $timestamps = true;

    protected $fillable = [
        'userId',
        'year',
        'degree',
        'field_of_study',
        'institution',
    ];

}
