<?php

namespace App\Http\Requests\ItemRequests;

use App\Http\Requests\BaseRequest;

class ItemPostRequest extends BaseRequest
{
    public function items(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|dimensions:ratio=1/1',
        ];
    }
}
