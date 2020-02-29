<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(ApiLoginRequest $request)
    {
        $credentials = $this->findCredentials($request);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse('invalid credentials', '400');
            }
        } catch (JWTException $e) {
            return $this->errorResponse('could not create token', '500');
        }

        return $this->respondWithToken($token);
    }

    public function register(ApiRegisterRequest $request)
    {
        $user = User::create([
                                 'name'     => $request->get('name'),
                                 'mobile'   => $request->get('mobile'),
                                 'email'    => $request->get('email'),
                                 'password' => Hash::make($request->get('password')),
                             ]);

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token, $user);
    }

    private function respondWithToken($token, $user = NULL)
    {
        $data = [
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ];
        if (!is_null($user)) {
            $data['user'] = $user;
        }
        return $this->successResponse($data);
    }

    private function findCredentials(Request $request)
    {
        $key = 'email';
        if (is_numeric($request->username)) {
            $key = 'mobile';
        }

        $credentials = [
            $key       => $request->username,
            'password' => $request->password,
        ];
        return $credentials;
    }
}
