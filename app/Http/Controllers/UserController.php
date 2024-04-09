<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\UserPostRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return new JsonResponse($users->load('orders', 'roles'),200);
    }

    /**
     * @param User|null $user
     * @return JsonResponse
     */
    public function getUser(?User $user): JsonResponse
    {
        return new JsonResponse($user->load('orders', 'roles'),200);
    }

    /**
     * @param UserPostRequest $request
     * @return JsonResponse
     */
    public function registerUser(UserPostRequest $request) : JsonResponse
    {
        $data = $request->getContent();
        $content = json_decode($data, true);

        $user = $this->userService->registerUser($content);

        $response = $user->load('roles', 'orders');

        return new JsonResponse($response,201);
    }

    /**
     * @param UserPostRequest $request
     * @return JsonResponse
     */
    public function createUser(UserPostRequest $request) : JsonResponse
    {
        $data = $request->getContent();

        $content = json_decode($data, true);

        $isAdministrator=false;

        $roles=$request->user()->load('roles')->roles;

        foreach ($roles as $role) {
            if ($role->role === "administrator") {
                $isAdministrator=true;
                break;
            }
        }

        if ($isAdministrator) {
            $user = $this->userService->createUser($content,$content["roles"]);

            $response = $user->load('roles', 'orders');

            return new JsonResponse($response,201);
        } else{
            return new JsonResponse("You have no permission",401);
        }
    }


    public function updateUser(UserPostRequest $request,User $user) : JsonResponse
    {
        $data = $request->getContent();

        $content = json_decode($data, true);

        $user = $this->userService->updateUser($content,$user);

        return new JsonResponse($user,200);

    }

    public function deleteUser(User $user) : JsonResponse
    {

        $this->userService->deleteUser($user->id);

        return new JsonResponse(`User with ID' . $user->id . 'has been deleted`,200);

    }
}

