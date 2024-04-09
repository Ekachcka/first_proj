<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesArray = [
            "visitor",
            "cooker",
            "administrator",
            "vip client",
            "waiter"
        ];

        foreach ($rolesArray as $roleValue) {
            $role = new Role;
            $role->role = $roleValue;
            $role->save();
        }
    }
}
