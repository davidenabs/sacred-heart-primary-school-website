<?php

namespace App\Listeners\Admin;

use App\Events\Admin\NewUserAddedEvent;
use App\Models\User;
use App\Notifications\Admin\NewUserAddedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewUserAddedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserAddedEvent $event): void
    {
        // send email to all admin
        $admin = User::admin()->get();
        Notification::send($admin, new NewUserAddedNotification($event->user));
    }
}
