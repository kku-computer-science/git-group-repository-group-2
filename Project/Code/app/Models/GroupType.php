<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    use HasFactory;
    protected $table = 'group_types';
    protected $primaryKey = 'typeId';
    public $timestamps = true;

    protected $fillable = [
        'typeName_en',
        'typeName_th',
    ];

    public function paperGroups()
    {
        return $this->hasMany(Papergroup::class, 'typeId', 'typeId');
    }
}
