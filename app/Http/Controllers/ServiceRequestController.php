<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Events\CallWebhookEvent;
use App\Http\Requests\AcceptServiceRequest;
use App\Http\Requests\AddServiceRequestRequest;
use App\Http\service\RequestService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

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
     * @return string
     */
    public function postRequest(AddServiceRequestRequest $request): string
    {
        try {
            return response()->json([
                'data' => $this->service->addRequest($request->all())->uuid
            ]);
        } catch (\Exception) {
            return response()->json([
                'message' => 'service request failed!'
            ]);
        }
    }

    /**
     * @param AcceptServiceRequest $request
     * @return JsonResponse
     */
    public function postAcceptByCourier(AcceptServiceRequest $request): JsonResponse
    {
        try {
            CallWebhookEvent::dispatch($request->input('longitude'), $request->input('latitude'), Status::TAKEN);
            $status = $this->service->acceptRequest($request->input('service_request_id'));
            return response()->json([
                'message' => $status ? 'request accepted!' : 'accept service request failed!'
            ]);
        } catch (\Exception) {
            return response()->json([
                'message' => 'accept service request failed!'
            ]);
        }
    }

    /**
     * @param AcceptServiceRequest $request
     * @return JsonResponse
     */
    public function getServicesRequests(AcceptServiceRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->getAllRequests()
            ]);
        } catch (\Exception) {
            return response()->json([
                'message' => 'you can not request for a service right now. please try again!'
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
        } catch (Throwable) {
            return response()->json([
                'message' => 'Invalid service request!'
            ]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function issueToken(Request $request): mixed
    {
        $user = User::query()->where([
            'email' => $request->email,
            'name' => $request->name
        ])->first();
        return $user->createToken('courier');
    }
}
