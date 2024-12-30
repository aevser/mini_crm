<?php

namespace App\Services\V1\Project;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(): Collection
    {
        return Project::all();
    }

    public function getOne(int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(int $id, array $data): Project
    {
        $project = $this->getOne($id);
        $project->update($data);

        return $project;
    }

    public function delete(int $id): bool
    {
        return $this->getOne($id)->delete();
    }

    public function toggleAssignment(int $id): bool
    {
        $project = $this->getOne($id);
        $settings = $project->settings;
        $settings['enabled'] = !$settings['enabled'];

        return $project->update(['settings' => $settings]);
    }
}
