<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Host extends Model
{
    protected $fillable = [
        'project_id',
        'url',
        'api_token'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
