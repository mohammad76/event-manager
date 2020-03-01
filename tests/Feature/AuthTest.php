<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_user()
    {
        $data = [
            'name'     => 'mohammad testi',
            'mobile'   => '09122002020',
            'email'    => 'test@test.com',
            'password' => '1234567890',
        ];

        $response = $this->post(route('api.user.register'), $data);
        $response->assertStatus(200);

    }

    public function test_user_can_login()
    {
        $user = $this->createUser();

        $response = $this->apiAs($user, 'GET', route('api.user.me'));
        $response->assertStatus(200);

    }
}
