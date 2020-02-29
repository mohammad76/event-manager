<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Event $event)
    {
        return $event->isCreator($user->id) || $event->isMember($user->id);
    }

    public function update(User $user, Event $event)
    {
        return $event->creator_id == $user->id;
    }

    public function delete(User $user, Event $event)
    {
        return $event->creator_id == $user->id;
    }

}
