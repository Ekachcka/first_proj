<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequests\OrderPostRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    )
    {
    }

    public function getAllOrders(): JsonResponse
    {
        $orders = $this->orderService->allOrders();

        return new JsonResponse($orders, 200);
    }

    public function getOrder(Order $order): JsonResponse
    {
        $order = $this->orderService->getOrderById($order);

        $response = $order->load('items');

        return new JsonResponse($response,200);
    }

    public function createOrder(OrderPostRequest $request) : JsonResponse
    {
        $data = $request->getContent();

        $userId = $request->user()->id;

        $content = json_decode($data, true);

        $order= $this->orderService->createOrder($content, $userId);

        $response = $order->load('items');

        return new JsonResponse($response, 201);
    }

    public function updateOrder(Order $order, OrderPostRequest $request): JsonResponse
    {
        $data = $request->getContent();

        $userId = $request->user()->id;

        $content = json_decode($data, true);

        $order= $this->orderService->updateOrder($order ,$content, $userId);

        $response = $order->load('items');

        return new JsonResponse($response, 200);
    }


    public function deleteOrder(Order $order): JsonResponse
    {
        $id = $order->id;

        $this->orderService->deleteOrder($id);

        return new JsonResponse(`Order with ID' . $id . 'has been deleted`, 200);

    }
}
