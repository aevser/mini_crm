<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Host extends Model
{
    const HOST_NOT_FOUND = 'host_not_found';

    protected $fillable = [
        'project_id',
        'host',
        'api_token',
        'enabled'
    ];

    protected $hidden = [
        'api_token'
    ];

    /*
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
