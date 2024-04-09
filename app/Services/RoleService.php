<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function getAllRole(): Collection
    {
        return Role::all();
    }

    public function createRole(array $data): Role
    {

        $role = new Role;

        $role->role = $data['role'];

        $role->save();
        return $role;
    }

    public function updateRole (array $data, Role $role): Role
    {
        $role->role = $data['role'] ?? $role->role;
        $role->save();
        return $role;
    }
    public function deleteUser(Role $role):void
    {
        $role->delete();
    }
}
