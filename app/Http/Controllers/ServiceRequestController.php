<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Http\Requests\AcceptServiceRequest;
use App\Http\Requests\AddServiceRequestRequest;
use App\Http\service\RequestService;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    private RequestService $service;

    /**
     * ServiceRequestController constructor.
     * @param RequestService $service
     */
    public function __construct(RequestService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AddServiceRequestRequest $request
     * @return Builder|Model
     */
    public function postRequest(AddServiceRequestRequest $request): Builder|Model
    {
        return $this->service->addRequest($request->all());
    }

    /**
     * @param AcceptServiceRequest $request
     */
    public function postAcceptByCourier(AcceptServiceRequest $request)
    {
        $this->service->acceptRequest($request->input('service_request_id'), Status::TAKEN);
    }

    /**
     * @param AcceptServiceRequest $request
     * @return JsonResponse
     */
    public function getServicesRequests(AcceptServiceRequest $request): JsonResponse
    {
        try{
            return response()->json([
                'data' => $this->service->getAllRequests()
            ]);
        }catch (\Exception){
            return response()->json([
                'message'=>'you can not request for a service right now. please try again!'
            ]);
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cancelServiceRequest(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'message' => $this->service->cancelServiceRequest($request->input('service_request_id'),
                    Status::CANCELED)
                    ? 'successful operation!'
                    : 'invalid request!'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Invalid service request!'
            ]);
        }
    }

    public function issueToken()
    {
        $user = User::query()->where('id', 1)->first();
        return $user->createToken('courier');
    }
}
