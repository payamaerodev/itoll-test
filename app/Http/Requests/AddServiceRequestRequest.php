<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddServiceRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'destination_longitude'=>'required|string|min:-180|max:180',
            'destination_latitude'=>'required|string|min:-90|max:90',
            'sender_name'=>'required|string|max:64',
            'receiver_name'=>'required|string|max:64',
            'receiver_number'=>'required|string|size:11',
            'sender_number'=>'required|string|size:11',
            'source_longitude'=>'required|string|min:-180|max:180',
            'source_latitude'=>'required|string|min:-90|max:90',
            'source_address'=>'required|string|max:255',
            'destination_address'=>'required|string|max:255',
            ];
    }
}
