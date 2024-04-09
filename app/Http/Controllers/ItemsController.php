<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequests\ItemPostRequest;
use App\Models\Item;
use App\Services\ItemsService;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
public function __construct(
    protected ItemsService $itemService
)
{
}

    /**
     * @return JsonResponse
     */
    public function getAllItems(): JsonResponse
    {
        $items = $this->itemService->getAllItems();
        return new JsonResponse($items, 200);
    }
    public function getItemById(Item $item): JsonResponse
    {
        return new JsonResponse($item, 200);
    }
    public function createItem(ItemPostRequest $request) : JsonResponse
    {
        $data = $request->getContent();

        $content = json_decode($data, true);

        $item = $this->itemService->createItem($content);

        return new JsonResponse($item, 201);
    }

    public function updateItem(ItemPostRequest $request,Item $item) : JsonResponse
    {
        $data = $request->getContent();

        $content = json_decode($data, true);

        $item = $this->itemService->updateItem($item, $content);

        return new JsonResponse($item, 200);
    }

    public function deleteItem(Item $item) : JsonResponse
    {
        $this->itemService->deleteItem($item);
        return new JsonResponse(null, 204);
    }

}
