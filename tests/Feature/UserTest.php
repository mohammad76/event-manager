<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_own_data()
    {
        $user     = $this->createUser();
        $response = $this->apiAs($user, 'GET', route('api.user.me'));
        $response->assertStatus(200);
    }

    public function test_user_can_edit_own_data()
    {
        $user     = $this->createUser();
        $data     = [
            'name' => 'new user',
            '_method' => 'PUT',
        ];
        $response = $this->apiAs($user, 'POST', route('api.user.me'), $data);
        $response->assertStatus(200);
        $this->assertEquals('new user' , $response->json()['data']['name']);
    }
}
