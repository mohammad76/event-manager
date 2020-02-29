<?php

namespace App\Http\Requests;

use App\Rules\EmailOrMobile;
use Illuminate\Foundation\Http\FormRequest;

class SendInvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invitations' => 'required',
            'invitations.*' => ['required' , 'distinct' , new EmailOrMobile],
        ];
    }
}
