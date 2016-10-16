<?php

namespace App\Listeners;

use App\Events\TodoFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTodoNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TodoFinished  $event
     * @return void
     */
    public function handle(TodoFinished $event)
    {
        //
    }
}
