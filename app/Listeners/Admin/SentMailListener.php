<?php

namespace App\Listeners\Admin;

use App\Events\Admin\SentMailEvent;
use App\Models\User;
use App\Notifications\Admin\NewMailSentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SentMailListener
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
    public function handle(SentMailEvent $event): void
    {
        // send email to main admin
        $admin = User::whereId('1')->get();
        Notification::send($admin, new NewMailSentNotification($event->mail));
    }
}
