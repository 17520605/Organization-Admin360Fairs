<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use Pusher\Pusher;

class Notification extends Model
{
    public $pusher;

    const INFO = 'info';
    const WARNING = 'warning';
    const SUCCESS = 'success';

    protected $table = 'notification';
    public $timestamps = true;

    public function send()
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            array(
                'cluster' => 'ap1',
                'encrypted' => true
            )
        );

        $pusher->trigger($this->to, $this->channel, json_encode($this));
    }
}
