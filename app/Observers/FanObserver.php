<?php

namespace App\Observers;

use App\Jobs\NotifyActorOfANewFan;
use App\Models\Fan;
use Illuminate\Support\Facades\Log;

class FanObserver
{
    /**
     * Handle the Fan "created" event. Queue a notification job for processing later.
     *
     * @param  \App\Models\Fan  $fan
     * @return void
     */
    public function created(Fan $fan)
    {
        NotifyActorOfANewFan::dispatch($fan);
    }

    /**
     * Handle the Fan "updated" event.
     *
     * @param  \App\Models\Fan  $fan
     * @return void
     */
    public function updated(Fan $fan)
    {
        //
    }

    /**
     * Handle the Fan "deleted" event.
     *
     * @param  \App\Models\Fan  $fan
     * @return void
     */
    public function deleted(Fan $fan)
    {
        //
    }

    /**
     * Handle the Fan "restored" event.
     *
     * @param  \App\Models\Fan  $fan
     * @return void
     */
    public function restored(Fan $fan)
    {
        //
    }

    /**
     * Handle the Fan "force deleted" event.
     *
     * @param  \App\Models\Fan  $fan
     * @return void
     */
    public function forceDeleted(Fan $fan)
    {
        //
    }
}
