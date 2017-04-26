<?php

namespace App\Notifications;

use Mail;
use App\Mail\taskSubmitted;
use Illuminate\Bus\Queueable;
use Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class userTaskSubmitted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        // fire off an email to the managers
        Mail::to(env('ADMIN_EMAIL'))->send(new taskSubmitted(Auth::user()));

        if (env('ADMIN_EMAIL_TWO') != "") {
            Mail::to(env('ADMIN_EMAIL_TWO'))->send(new taskSubmitted(Auth::user()));
        }

        if (env('ADMIN_EMAIL_THREE') != "") {
            Mail::to(env('ADMIN_EMAIL_THREE'))->send(new taskSubmitted(Auth::user()));
        }

        if (env('ADMIN_EMAIL_FOUR') != "") {
            Mail::to(env('ADMIN_EMAIL_FOUR'))->send(new taskSubmitted(Auth::user()));
        }

        if (env('ADMIN_EMAIL_FIVE') != "") {
            Mail::to(env('ADMIN_EMAIL_FIVE'))->send(new taskSubmitted(Auth::user()));
        }

        return (new MailMessage)
                    ->line('Thank you for submission. A manager will review your answer and possibly contact you shortly to discuss your answer.')
                    //->action('Onboarding', 'http://site.com')
        ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
