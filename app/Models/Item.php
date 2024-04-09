<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Item::class,
            'item_order',
            'item_id',
            'order_id'
        );
    }
}
