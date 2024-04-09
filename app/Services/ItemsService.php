<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemsService
{
    /**
     * @return Collection
     */
    public function getAllItems(): Collection
    {
        return Item::all();
    }
    /**
     * @param array $data
     * @return ItemZ
     */
    public function createItem(array $data):  Item
    {
        $item = new Item;

        $item->name = $data['name'];
        $item->price = $data['price'];

        $item->save();
        return $item;
    }
    public function updateItem(Item $item, array $data):  Item
    {
        $item->name = $data['name']??$item->name;
        $item->price = $data['price']??$item->price;

        $item->save();
        return $item;
    }
    public function deleteItem(Item $item):  void
    {
        $item->delete();
    }
}
