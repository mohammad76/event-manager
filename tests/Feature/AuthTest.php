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

        $response =  $this->post('api/register', $data , ['Accept' , 'application/json']);
          $response->assertStatus(200);

    }
}
