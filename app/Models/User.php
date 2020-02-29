<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myEvents()
    {
        return $this->hasMany(Event::class, 'creator_id', 'id');

    }

    public function invitedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_members', 'invited_id')
            ->where('status', 'accepted');
    }

    public function received_invitations()
    {
        return $this->hasMany(EventMember::class, 'invited_id', 'id')->with('event', 'invitor');

    }

    public function send_invitations()
    {
        return $this->hasMany(EventMember::class, 'inviter_id', 'id')->with('event', 'invited');

    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
