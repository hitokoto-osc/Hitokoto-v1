<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use SoftDeletes;

    protected $table = 'ticket';

    protected $fillable = [
        'uid',
        'title',
        'content',
        'attachment',
        'open_time',
        'last_update'
    ];

    public function ticket_replies ()
    {
        return $this->hasMany('App\TicketReply', 'belong_to');
    }

    public function publisher ()
    {
        return $this->belongsTo('App\User', 'uid');
    }
}
