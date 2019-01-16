<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable;

    protected $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function toMail($notifiable)
    {
        if (static::$toMailCallback)
        {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->subject(Lang::getFromJson('Verify Email Address'))
            ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
            ->line(Lang::getFromJson('After verification, you can log in with your password and unique customer number. Your number: ' . $this->number ))
            ->action(
                Lang::getFromJson('Verify Email Address'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
    }
}
