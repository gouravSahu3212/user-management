<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApiResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Redirect url to sent in emal.
     *
     * @var string
     */
    protected $redirectURL;

    /**
     * Password reset token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token, string $redirectURL)
    {
        $this->token = $token;
        $this->redirectURL = $redirectURL;
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
        return (new MailMessage)
            ->subject('Password Reset')
            ->greeting('Hello!')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $this->redirectURL . '?token=' . $this->token)
            ->line('If you did not request a password reset, no further action is required.');
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
