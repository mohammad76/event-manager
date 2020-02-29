<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [ 'creator_id', 'name', 'description' ];
    protected $appends  = [ 'type' ];

    public function getTypeAttribute()
    {
        $id = auth()->user()->id;
        if ($this->isCreator($id)) {
            return 'creator';
        } elseif ($this->isMember($id)) {
            return 'guest';
        }
    }

    public function isCreator($userId)
    {
        return $this->creator_id == $userId;
    }

    public function isInvited($userId)
    {
        $item = EventMember::where('event_id', $this->id)->where('invited_id', $userId)->where('status', '!=', 'rejected')->first();
        return (bool) $item;
    }

    public function isMember($userId)
    {
        $members = $this->members()->pluck('users.id')->toArray();
        return in_array($userId, $members);
    }

    public function invitations()
    {
        return $this->hasMany(EventMember::class, 'event_id', 'id')->with('invitor', 'invited');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'event_members', 'event_id', 'invited_id', 'id')
            ->where('status', 'accepted');
    }
}
