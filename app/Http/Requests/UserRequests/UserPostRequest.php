<?php

namespace App\Http\Requests\UserRequests;

use App\Http\Requests\BaseRequest;
class UserPostRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|alpha_dash:ascii|string',
            'email' => 'required|email|unique:users,email|string',
            'password'=> 'required|min:6|string',
        ];
    }
}
