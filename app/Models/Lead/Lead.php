<?php

namespace App\Models\Lead;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    const LEAD_NEW = 'new';
    const LEAD_EXISTS = 'exists';

    const SOURCE_DIRECT_ENTRY = 'direct_entry';

    protected $fillable = [
        'project_id',
        'class_id',
        'owner',
        'company',
        'status',
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
        'host',
        'ip',
        'source',
        'url_query_string',
        'utm',
        'nextcall_date',
    ];

    protected $casts = [
        'utm' => 'array',
    ];

    /*
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
