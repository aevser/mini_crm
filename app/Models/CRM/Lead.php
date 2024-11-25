<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'project_id',
        'status',
        'name',
        'phone',
        'email',
        'comment',
        'city',
        'region',
        'host',
        'ip'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
