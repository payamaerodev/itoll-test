<?php

namespace App\Http\service;

use App\Enum\Status;
use App\Http\service\ServiceRequestRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

        return $this->repository->updateServiceRequestStatus($service_request_id, $status);
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function addRequest(array $data): Builder|Model
    {
        return $this->repository->addServiceRequest($data);
    }

    /**
     * @return Collection|array
     */
    public function getAllRequests(): Collection|array
    {
        return $this->repository->getAllServiceRequests();
    }

    public function acceptRequest(mixed $service_request_id, string $TAKEN)
    {
        $request = $this->repository->findById($service_request_id);
        if ($request->status === Status::CREATED) {
            $this->repository->updateServiceRequestStatus($service_request_id, Status::CANCELED);
        }
    }
}
