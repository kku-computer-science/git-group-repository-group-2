<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sourcepaper extends Model
{
    use HasFactory;
    protected $primaryKey = 'sourceId';

    public function sourceType()
    {
        return $this->belongsTo(SourceType::class, 'sourceTypeId');
    }
}
