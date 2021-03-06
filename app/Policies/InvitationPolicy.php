<?php

namespace App\Policies;

use App\Models\Invitation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    public function send(User $user, Event $event)
    {
        return $event->isCreator($user->id) || $event->isMember($user->id);
    }


    public function answer(User $user, Invitation $eventMember)
    {
        return $eventMember->invited_id == $user->id;
    }

    public function delete(User $user, Invitation $eventMember)
    {
        return $eventMember->inviter_id == $user->id && $eventMember->status == 'pending';
    }

    public function restore(User $user, Invitation $eventMember)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the event member.
     * @param \App\Models\User $user
     * @param \App\EventMember $eventMember
     * @return mixed
     */
    public function forceDelete(User $user, Invitation $eventMember)
    {
        //
    }
}
