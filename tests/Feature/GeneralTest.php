<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_table()
    {
        $event = factory(Event::class)->create();
        $this->assertDatabaseHas('events', [
            'name' => $event->name,
        ]);
    }
    public function test_user_table()
    {
        $user = $this->createUser();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);
    }
}
