<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_event()
    {

        $user = $this->createUser();
        $data = [
            'creator_id'  => 1,
            'name'        => 'Test Event',
            'description' => 'Test Event Description',
        ];

        $this->apiAs($user, 'POST', 'api/events', $data)->assertStatus(201)->assertJson([ "status" => "success" ]);
    }

    public function test_can_see_event()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);
        $this->apiAs($user, 'GET', route('events.show', $event->id))->assertStatus(200)->assertJson([ "status" => "success" ]);
    }

    public function test_can_see_event_invitations()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);
        $this->apiAs($user, 'GET', route('events.show.invitations', $event->id))->assertStatus(200)->assertJson([ "status" => "success" ]);
    }

    public function test_creator_can_update_event()
    {
        $user    = $this->createUser();
        $event   = $this->createEvent($user);
        $newData = [ 'name' => 'Updated name' ];
        $this->apiAs($user, 'PUT', route('events.update', $event->id), $newData)
            ->assertStatus(200)
            ->assertJson([ "status" => "success" ]);
    }

    public function test_other_user_can_update_event()
    {
        $user    = $this->createUser();
        $event   = factory(Event::class)->create();
        $newData = [ 'name' => 'Updated name' ];
        $this->apiAs($user, 'PUT', route('events.update', $event->id), $newData)
            ->assertStatus(403);
    }

    private function createUser()
    {
        $userData = [
            'name'     => 'mohammad testi',
            'mobile'   => '09122002020',
            'email'    => 'test@test.com',
            'password' => '1234567890',
        ];
        return User::create($userData);
    }

    private function createEvent($user)
    {
        $eventData = [
            'name'        => 'Event Test',
            'description' => 'Event Test Description',
        ];
        return $user->myEvents()->create($eventData);
    }

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
}
