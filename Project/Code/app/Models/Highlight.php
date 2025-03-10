<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Highlight extends Model
{
    use HasFactory;

    protected $table = 'highlights';

    protected $fillable = [
        'title',
        'detail',
        'thumbnail',
        'tags',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class, 'highlight_tag');
    }
}
