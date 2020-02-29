<?php

namespace App\Http\Requests;

use App\Rules\EmailOrMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ApiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {
        return [
            'username' => [ 'required', 'string', 'max:255', new EmailOrMobile ],
            'password' => 'required|string',
        ];
    }
}
