<?php

namespace App\Notifications;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\ModuleQuestion;
use App\Models\UserModuleAnswer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotAllPreviousMonthsModulesCompleted extends Notification
{
    use Queueable;

    private $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
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
        $count = $this->info['count'];

        // fire off an email to the managers
        Mail::to(env('ADMIN_EMAIL'))->send(new notCompletedModules($notifiable));

        return (new MailMessage)
                    ->line('Hi '.$notifiable->name)
                    ->line('You\'re receiving this email because you\'ve got '.$count.' outstanding
                     task(s) to complete and proceed to the next module.')
                    ->action('Click here to complete',
                        'https://onboarding.fcacomplianceservices.com/module')
                    ->line('Please click the above link to be taken to the modules you need to complete.');
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
