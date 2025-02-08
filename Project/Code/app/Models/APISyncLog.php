<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APISyncLog extends Model
{
    use HasFactory;
    protected $table = 'api_sync_logs';
    protected $primaryKey = 'logId';
    public $timestamps = false;

    protected $fillable = [
        'paperId',
        'sourceTypeId',
        'sourceId',
        'syncStatus',
        'errorMessage',
        'syncTime',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paperId', 'paperId');
    }

    public function sourceType()
    {
        return $this->belongsTo(SourceType::class, 'sourceTypeId', 'sourceTypeId');
    }

    public function source()
    {
        return $this->belongsTo(Sourcepaper::class, 'sourceId', 'sourceId');
    }
}
