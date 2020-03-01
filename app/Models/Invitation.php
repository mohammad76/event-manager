<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['event_id' , 'inviter_id' , 'invited_id' , 'status'];
    protected $hidden = [ 'event_id', 'inviter_id', 'invited_id' ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
    public function invitor()
    {
        return $this->belongsTo(User::class, 'inviter_id', 'id');
    }

    public function invited()
    {
        return $this->belongsTo(User::class, 'invited_id', 'id');
    }
}
