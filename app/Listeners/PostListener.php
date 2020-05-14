<?php

namespace App\Listeners;

use App\Notifications\PostNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class PostListener implements ShouldQueue
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
        // User::all()
        //     ->except($post->user_id)
        //     ->each(function (User $user) use ($post) {
        //         $user->notify(new PostNotification($post));
        //     });
        User::all()
            ->except($event->post->user_id)
            ->each(function(User $user) use($event){
                Notification::send($user, new PostNotification($event->post));
            // Notification::send($users, new InvoicePaid($invoice))
                
            });
    }
}
