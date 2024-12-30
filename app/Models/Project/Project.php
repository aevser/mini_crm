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
                "timezone": "UTC"
            }'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    /*
     * Relations
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
