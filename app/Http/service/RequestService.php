<?php

namespace App\Http\service;

use App\Enum\Status;
use App\Events\CallWebhookEvent;
use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

class RequestService
{
    private ServiceRequestRepository $repository;


    public function __construct(ServiceRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $service_request_id
     * @param string $status
     * @return int
     * @throws Throwable
     */
    public function cancelServiceRequest(int $service_request_id, string $status): int
    {
        throw_if($this->repository->findById($service_request_id)->user_id !== Auth::id(), \Exception::class);
        $request = $this->repository->findById($service_request_id);
        if ($request->status === Status::CREATED) {
            return $this->repository->updateServiceRequestStatus($service_request_id, Status::CANCELED);
        }
        return $this->repository->updateServiceRequestStatus($service_request_id, $status);
    }

    /**
     * @param array $data
     * @return Model|Builder
     */
    public function addRequest(array $data): Model|Builder
    {
        return $this->repository->addServiceRequest(array_merge($data, ['status' => Status::CREATED, 'user_id' => Auth::id(), 'uuid' => Str::uuid()->toString()]));
    }

    /**
     * @return Collection|array
     */
    public function getAllRequests(): Collection|array
    {
        return $this->repository->getAllServiceRequests();
    }

    /**
     * @param mixed $service_request_id
     * @param int $longitude
     * @param int $latitude
     * @return bool|int
     */
    public function acceptRequest(mixed $service_request_id, int $longitude, int $latitude): bool|int
    {
        $service_request = ServiceRequest::query()->where('id', $service_request_id)->first();
        CallWebhookEvent::dispatch($service_request->webhook_url, $longitude, $latitude, Status::TAKEN);
        $request = $this->repository->findById($service_request_id);
        if ($request->status === Status::CREATED) {
            return $this->repository->updateServiceRequestStatus($service_request_id, Status::TAKEN);
        }
        return false;
    }
}
