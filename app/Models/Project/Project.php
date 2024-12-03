<?php

namespace App\Models\Project;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'api_token',
        'timezone',
        'color',
        'enabled',
        'lead_validation_days',
        'detect_region',
        'calltracking',
        'leads_today',
        'leads_total'
    ];

    /*
     * Relations
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
