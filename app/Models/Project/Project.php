<?php

namespace App\Models\Project;

use App\Models\Lead\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'api_token',
        'settings'
    ];

    protected $attributes = [
        'settings' =>
            '{
                "enabled": true,
                "description": false,
                "color": "5F9EA0",
                "lead_validation_days": 0,
                "detect_region": false,
                "timezone": "UTC",
                "leads_today": 0,
                "leads_total": 0
            }'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    protected $hidden = [
        'api_token'
    ];

    /*
     * Relations
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
