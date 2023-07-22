<?php

namespace App\Http\service;

use App\Enum\Status;
use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestRepository
{
    /**
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(int $id): bool|int
    {
        return ServiceRequest::query()->findOrFail($id)->lockForUpdate()->update(['status' => Status::TAKEN]);
    }

    /**
     * @return Collection|array
     */
    public function getAllServiceRequests(): Collection|array
    {
        return ServiceRequest::query()->where('status', Status::CREATED)->get();
    }

    /**
     * @param array $data
     * @return Model|Builder
     */
    public function addServiceRequest(array $data): Model|Builder
    {
        return ServiceRequest::query()->create($data);
    }

    public function updateServiceRequestStatus(int $id, string $status): int
    {
        return ServiceRequest::query()->where('id', $id)->update(['status' => $status]);

    }

    public function findById(int $service_request_id): Model|Collection|Builder|array|null
    {
        return ServiceRequest::query()->where('id', $service_request_id)->first();
    }
}
