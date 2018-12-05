<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\NewUserPasswordResetEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewUserPasswordResetEmail
{
    /**
     * @var Illuminate\Auth\Passwords\PasswordBroker 
     */
    private $passwordBroker;

    /**
     * Create the event listener.
     *
     * @param Illuminate\Auth\Passwords\PasswordBroker $passwordBroker
     * @return void
     */
    public function __construct(\Illuminate\Auth\Passwords\PasswordBroker $passwordBroker)
    {
        $this->passwordBroker = $passwordBroker;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $token = $this->passwordBroker->createToken($event->user);

        Mail::to($event->user->email)->send(
            new NewUserPasswordResetEmail($event->user, $token)
        );
    }
}
