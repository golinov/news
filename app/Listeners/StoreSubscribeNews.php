<?php

namespace App\Listeners;

use App\Events\SubscribeNews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function PHPUnit\Framework\isTrue;

class StoreSubscribeNews
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
     * @param SubscribeNews $event
     * @return void
     */
    public function handle(SubscribeNews $event)
    {
        $event->user->update([
            'is_sub' => $event->user->is_sub ? false : true,
            'sub_at' => !$event->user->is_sub ? now() : null
        ]);
    }
}
