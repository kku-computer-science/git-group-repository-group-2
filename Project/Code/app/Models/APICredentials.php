<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APICredentials extends Model
{
    use HasFactory;
    protected $table = 'api_credentials';
    protected $primaryKey = 'credentialId';
    public $timestamps = false;

    protected $fillable = [
        'sourceTypeId',
        'lastUpdated',
    ];

}
