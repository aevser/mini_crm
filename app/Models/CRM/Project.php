<?php

namespace App\Models\CRM;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'api_token',
        'enabled',
        'leads_today',
        'leads_total'
    ];

    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
