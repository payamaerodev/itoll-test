<?php

namespace App\Http\service;

use App\Enum\Status;
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

    public function acceptRequest(mixed $service_request_id): bool|int
    {
        $request = $this->repository->findById($service_request_id);
        if ($request->status === Status::CREATED) {
            return $this->repository->updateServiceRequestStatus($service_request_id, Status::TAKEN);
        }
        return false;
    }
}
