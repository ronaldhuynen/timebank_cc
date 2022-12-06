<?php

namespace App\Listeners;

use App\Jobs\RedirectToDashboard as JobsRedirectToDashboard;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;


class RedirectToDashboard
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        info('Redirect to Dashboard');
        dispatch(new JobsRedirectToDashboard);
    }
}
