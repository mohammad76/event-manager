<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function loggedUser()
    {
        $user = auth()->user();
        $this->authorize('view' , $user);
        return $this->successResponse($user);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $this->authorize('update' , $user);
        if ($request->has('avatar')) {
            $avatar = $request->file('avatar')->store('public/avatars');
            $avatar = str_replace('public', 'storage', $avatar);
            $user->update(compact('avatar'));
        }
        if ($request->has('name')) {
            $user->update($request->only('name'));
        }
        if ($request->has('password')) {
            $user->update([
                              'password' => \Hash::make($request->password),
                          ]);
        }
        return $this->successResponse($user);
    }
}
