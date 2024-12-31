<?php

namespace App\Services\V1\Project\Host;

use App\Models\Project\Host;
use App\Models\Project\Project;
use Illuminate\Support\Str;

class HostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): Host
    {
        return Host::create($data);
    }

    public function delete(Project $project, int $id): bool
    {
        return Host::destroy($id);
    }
}
