<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $table = 'highlight';

    protected $fillable = [
        'title',
        'detail',
        'thumbnail',
        'upload_date',
        'tags',
    ];
}
