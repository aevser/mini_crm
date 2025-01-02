<?php

namespace App\Services\V1\Project\Classes;

use App\Models\Lead\Lead;
use App\Models\Project\Classes\LeadClass;
use App\Models\Project\Project;

class ClassService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): LeadClass
    {
        return LeadClass::create($data);
    }

    public function update(int $id, array $data): LeadClass
    {
        $class = LeadClass::findOrFail($id);
        $class->update($data);

        return $class;
    }

    public function delete(int $id): void
    {
        LeadClass::destroy($id);
    }

    public function assignClasses(Project $project, Lead $lead, array $data): bool
    {
        return Lead::query()
            ->where('id', $lead->id)
            ->update([
                'class_id' => $data['class_id'] ? $data['class_id'] : null,
            ]);
    }
}
