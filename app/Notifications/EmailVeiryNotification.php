<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVeiryNotification extends Notification
{
    use Queueable;

    public $code;
    public $userName;
    
    public function __construct($code,$userName)
    {
        $this->code = $code;
        $this->userName = $userName;
    }

    
    public function via($notifiable)
    {
        return ['mail'];
    }

  
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from('barrett@example.com', 'Barrett Blair')->from('barrett@example.com', 'Barrett Blair')
                    ->subject('Verify your account.')
                    ->greeting('Dear '.$this->userName)
                    
                    ->line('We hope this message finds you well. In order to ensure the security of your account and maintain 
                        a safe environment for all our users.
                        Your account verification code is')
                    ->action($this->code, url('/'))

                    ->line('We are implementing an account verification process.
                    This process helps us confirm the authenticity of your account and protect it from unauthorized access.
                    Please complete the account verification process')
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
