<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Host extends Model
{
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
