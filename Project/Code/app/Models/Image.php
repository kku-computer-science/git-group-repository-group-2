<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'highlight_id',
        'image_path'
    ];

    public function highlight()
    {
        return $this->belongsTo(Highlight::class);
    }
}
