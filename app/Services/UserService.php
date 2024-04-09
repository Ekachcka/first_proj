<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }
    private function doUser(array $data,array $roles): User
    {
        $user = new User();
        $user->name = $data['name'] ;
        $user->email = $data['email'] ;
        $user->password = $data['password'];
        $user->save();
        foreach ($roles as $role_name) {
            $role = Role::where("role",$role_name)->first();
            if ($role!==null) $user->items()->attach($role->id);
        }

        return $user;
    }
    public function createUser(array $data, array $roles): User
    {
        $user=$this->doUser($data,$roles);
        return $user;
    }
    public function registerUser(array $data ): User
    {
        $user=$this->doUser($data,["visitor"]);
        return $user;
    }
    public function updateUser( array $data,User $user): User
    {
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->password = $data['password'] ?? $user->password;
        $user->save();
        return $user;
    }
    public function deleteUser(int $id): void
    {
        User::findOrFail($id)->delete();
    }
}
