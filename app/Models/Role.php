<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,
            'user_role',
            'role_id',
            'user_id'
        );
    }
}
