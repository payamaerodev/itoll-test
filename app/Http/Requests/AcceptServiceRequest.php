<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptServiceRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'service_request_id' => 'required|exists:service_requests,id|int',
            'longitude' => 'required|int',
            'latitude' => 'required|int',
        ];
    }
}
