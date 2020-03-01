<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function apiAs($user, $method, $uri, array $data = [], array $headers = [])
    {
        $headers = array_merge([
                                   'Authorization' => 'Bearer ' . \JWTAuth::fromUser($user),
                               ], $headers);

        return $this->api($method, $uri, $data, $headers);
    }


    protected function api($method, $uri, array $data = [], array $headers = [])
    {
        return $this->json($method, $uri, $data, $headers);
    }

    protected function createUser()
    {
        return factory(User::class)->create();

    }

    protected function createEvent($user)
    {
        $eventData = [
            'name'        => 'Event Test',
            'description' => 'Event Test Description',
        ];
        return $user->myEvents()->create($eventData);
    }
}
