<?php

namespace App\Models\Project\Classes;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadClass extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'type',
        'color'
    ];

    /*
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
