<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function allOrders(): Collection
    {
        return Order::all();
    }

    public function getOrderById(Order $order): ?Order
    {
        return $order;
    }
    public function createOrder(array $data, int $userId): Order
    {
        $order = new Order;

        $order->price=0;
        $order->description = $data["description"];
        $order->user_id = $userId;
        $items_names = $data["items"];

        foreach ($items_names as $name) {
            $item = Item::where("name",$name)->first();
            if ($item!==null) $order->price+=$item->price;
        }

        $order->save();

        foreach ($items_names as $name) {
            $item = Item::where("name",$name)->first();
            if ($item!==null) $order->items()->attach($item->id);
        }

        return $order;
    }
    public function updateOrder(Order $order, array $data, int $userId): Order
    {
        $order->price = $data['price'] ?? $order->price;
        $order->description = $data['description'] ?? $order->price;
        $order->user_id = $userId ?? $order->user_id;
        $order->save();
        return $order;
    }
    public function deleteOrder(int $id): void
    {
        Order::findOrFail($id)->delete();
    }
}
