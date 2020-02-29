<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReceivedInvitationsRequest extends FormRequest
{
    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {
        return [
            'status' => [Rule::in(['pending', 'accepted', 'rejected' , 'all'])]
        ];
    }
}
