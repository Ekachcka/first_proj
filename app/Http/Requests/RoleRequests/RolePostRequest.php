<?php

namespace App\Http\Requests\RoleRequests;

use App\Http\Requests\BaseRequest;

class RolePostRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'role' => 'required|alpha_dash:ascii|string',
        ];
    }
}
