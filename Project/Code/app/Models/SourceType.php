<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceType extends Model
{
    use HasFactory;
    protected $table = 'source_types';
    protected $primaryKey = 'sourceTypeId';
    public $timestamps = false;
    protected $fillable = ['sourceTypeId', 'sourceTypeName'];
}
