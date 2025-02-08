<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papergroup extends Model
{
    use HasFactory;
    protected $table = 'papergroups';
    protected $primaryKey = 'groupId';
    public $timestamps = true;

    protected $fillable = [
        'groupName_en',
        'groupName_th',
        'typeId',
        'authorId',
    ];

    public function groupType()
    {
        return $this->belongsTo(GroupType::class, 'typeId', 'typeId');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'authorId', 'authorId');
    }

    public function papers()
    {
        return $this->hasMany(Paper::class, 'groupId', 'groupId');
    }
}
