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
            'creator_id'  => $user->id,
            'name'        => 'Test Event',
            'description' => 'Test Event Description',
        ];

        $response = $this->apiAs($user, 'POST', route('api.events.store'), $data);
        $response->assertStatus(201)->assertJson([ "status" => "success" ]);
    }

    public function test_can_see_event()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);
        $response =  $this->apiAs($user, 'GET', route('api.events.show', $event->id));
        $response->assertStatus(200)->assertJson([ "status" => "success" ]);

    }

    public function test_can_see_event_invitations()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);
        $this->apiAs($user, 'GET', route('api.events.show.invitations', $event->id))->assertStatus(200)->assertJson([ "status" => "success" ]);
    }

    public function test_creator_can_update_event()
    {
        $user    = $this->createUser();
        $event   = $this->createEvent($user);
        $newData = [ 'name' => 'Updated name' ];
        $this->apiAs($user, 'PUT', route('api.events.update', $event->id), $newData)
            ->assertStatus(200)
            ->assertJson([ "status" => "success" ]);
    }

    public function test_not_creator_can_update_event()
    {
        $user    = $this->createUser();
        $event   = factory(Event::class)->create();
        $newData = [ 'name' => 'Updated name' ];
        $this->apiAs($user, 'PUT', route('api.events.update', $event->id), $newData)
            ->assertStatus(403);
    }

    public function test_creator_can_delete_event()
    {
        $user  = $this->createUser();
        $event = $this->createEvent($user);
        $this->apiAs($user, 'DELETE', route('api.events.destroy', $event->id))
            ->assertStatus(200)
            ->assertJson([ "status" => "success" ]);
    }

    public function test_not_creator_can_delete_event()
    {
        $user  = $this->createUser();
        $event = factory(Event::class)->create();
        $this->apiAs($user, 'DELETE', route('api.events.destroy', $event->id))
            ->assertStatus(403);
    }

    public function test_update_event_work_correct()
    {
        $user     = $this->createUser();
        $event    = $this->createEvent($user);
        $newData  = [ 'name' => 'Updated name', 'description' => 'Updated description' ];
        $response = $this->apiAs($user, 'PUT', route('api.events.update', $event->id), $newData)->json();
        $this->assertEquals('Updated name', $response['data']['name']);
        $this->assertEquals('Updated description', $response['data']['description']);
    }

    public function test_other_user_can_update_event()
    {
        $user    = $this->createUser();
        $event   = factory(Event::class)->create();
        $newData = [ 'name' => 'Updated name' ];
        $this->apiAs($user, 'PUT', route('api.events.update', $event->id), $newData)
            ->assertStatus(403);
    }

}
