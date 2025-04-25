<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $fillable = ['name'];

    public function highlights()
    {
        return $this->belongsToMany(Highlight::class, 'highlight_tag', 'tag_id', 'highlight_id');
    }
}