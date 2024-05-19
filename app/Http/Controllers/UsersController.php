<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlabsRequest;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(UsersRequest $request): User
    {
        return User::create($request->validated());
    }

    public function show(User $users): User
    {
        return $users;
    }


    public function update(SlabsRequest $request, User $users): User
    {
        $users->update($request->validated());

        return $users;
    }

    public function destroy(User $users): JsonResponse
    {
        $users->delete();

        return response()->json();
    }
}
