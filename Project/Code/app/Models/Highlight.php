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
        'user_id',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'highlight_tag', 'highlight_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
