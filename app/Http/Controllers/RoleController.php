<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequests\RolePostRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function __construct(
        private RoleService $roleService
    )
    {
    }

    public function getAllroles(): JsonResponse
    {
        $roles = $this->roleService->getAllRole();
        return new JsonResponse($roles,200);
    }
    public function getroles(Role $role): JsonResponse
    {
        return new JsonResponse($role,200);
    }

    public function createroles(RolePostRequest $request) : JsonResponse
    {
        $data = $request->getContent();

        $content = json_decode($data, true);

        $role = $this->roleService->createRole($content);

        return new JsonResponse($role, 201);
    }

    public function deleteroles(Role $role): JsonResponse
    {
        $this->roleService->deleteUser($role);
        return new JsonResponse($role,200);
    }

    public function updateroles(RolePostRequest $request, Role $role) : JsonResponse
    {
        $data = $request->getContent();
        $content = json_decode($data, true);
        $role = $this->roleService->updateRole($content,$role);


        return new JsonResponse($role,200);

    }
}
