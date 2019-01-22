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
            ->subject(Lang::getFromJson('Bevestig uw e-mailadres'))
            ->line(Lang::getFromJson('Klik op de onderstaande knop om uw e-mailadres te verifiëren.'))
            ->line(Lang::getFromJson('Na verificatie kunt u inloggen met uw wachtwoord en unieke klantnummer. Uw nummer: ' . $this->number ))
            ->action(
                Lang::getFromJson('Bevestig e-mailadres'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('Als u geen account heeft aangemaakt, hoeft u verder niets te doen.'));
    }
}
