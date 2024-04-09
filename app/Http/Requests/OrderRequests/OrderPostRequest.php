<?php

namespace App\Http\Requests\OrderRequests;

use App\Http\Requests\BaseRequest;

class OrderPostRequest extends BaseRequest
{
    public function orders(): array
    {
        return [
            'description' => 'required|string',
        ];
    }
}
