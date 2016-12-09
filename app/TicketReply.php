<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_reply';

    protected $fillable = [
        'belong_to',
        'uid',
        'content',
        'attachment',
        'reply_time'
    ];

    public function publisher ()
    {
        return $this->belongsTo('App\User', 'uid');
    }
}
