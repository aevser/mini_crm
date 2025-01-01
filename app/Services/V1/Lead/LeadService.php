<?php

namespace App\Services\V1\Lead;

use App\Events\LeadCount;
use App\Models\Lead\Lead;
use App\Models\Project\Host;
use App\Models\Project\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class LeadService
{
    use ApiResponse;

    public function validateHost(string $host, int $project_id): bool
    {
        return Host::query()
            ->where('host', $host)
            ->where('project_id', $project_id)
            ->exists();
    }

    public function handleInvalidHost(): JsonResponse
    {
        return $this->leadError(Host::HOST_NOT_FOUND, trans('lead/messages.error.host_not_found'));
    }

    public function handleLeadCreation(array $data): JsonResponse
    {
        $lead_status = $this->checkLeadStatus($data['phone'], $data['project_id']);

        $lead = $this->leadData($data);

        event(new LeadCount($lead));

        if ($lead_status['exists']) {
            $lead->status = Lead::LEAD_EXISTS;
            $lead->save();

            return $this->leadRepeat(
                Lead::LEAD_EXISTS,
                trans('lead/messages.success.exists', ['count' => $lead_status['count'] + 1])
            );
        }

        return $this->leadAdd(Lead::LEAD_NEW, trans('lead/messages.created'));
    }

    private function checkLeadStatus(string $phone, int $project_id): array
    {
        $count = Lead::query()
            ->where('phone', $phone)
            ->where('project_id', $project_id)
            ->count();

        return [
            'exists' => $count > 0,
            'count' => $count,
        ];
    }

    private function leadData(array $data): Lead
    {
        $lead = $this->create($data);
        $lead->source = $this->detectSource($data);
        $lead->utm = $this->getUtmParameters($data);
        $lead->save();

        return $lead;
    }

    private function detectSource(array $data): string
    {
        if (!empty($data['referrer']) &&
            (parse_url($data['referrer'], PHP_URL_HOST) !== parse_url($data['host'], PHP_URL_HOST))) {
            return parse_url($data['referrer'], PHP_URL_HOST);
        }

        if (empty($data['url_query_string'])) {
            return Lead::SOURCE_DIRECT_ENTRY;
        }

        $utm = [];
        parse_str(parse_url($data['url_query_string'], PHP_URL_QUERY), $utm);

        return $utm['utm_source'] ?? Lead::SOURCE_DIRECT_ENTRY;
    }

    private function getUtmParameters(array $data): array
    {
        $src = $data['url_query_string'] ?? $data['referrer'] ?? null;

        if (is_null($src)) {
            return [];
        }

        $vars = [];
        parse_str(parse_url($data['url_query_string'], PHP_URL_QUERY), $vars);

        $utm = [];

        foreach (['utm_source', 'utm_campaign', 'utm_medium', 'utm_term'] as $utm_mark) {
            if (array_key_exists($utm_mark, $vars)) {
                $utm[$utm_mark] = $vars[$utm_mark];
            }
        }

        return $utm;
    }

    public function create(array $data): Lead
    {
        return Lead::create($data);
    }

    public function delete(int $id): void
    {
        Lead::destroy($id);
    }
}
