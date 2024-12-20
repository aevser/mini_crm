<?php

namespace App\Models\Lead;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'project_id',
        'owner',
        'company',
        'name',
        'surname',
        'patronymic',
        'full_name',
        'phone',
        'entries',
        'email',
        'cost',
        'comment',
        'city',
        'region',
        'manual_region',
        'manual_city',
        'ip',
        'referrer',
        'source',
        'utm',
        'utm_medium',
        'utm_source',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'host',
        'url_query_string',
        'nextcall_date',
    ];

    /*
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
