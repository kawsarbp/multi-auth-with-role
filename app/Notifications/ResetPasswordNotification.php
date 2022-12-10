<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rules;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $getEmail;
    public $route;
    public $token;
    public function __construct($getEmail,$route,$token)
    {
        $this->getEmail = $getEmail;
        $this->route = $route;
        $this->token = $token;
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
            ->subject(Lang::get('Reset Password Notification'))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'),route($this->route,['token'=>$this->token,'email'=>$this->getEmail]))
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));

//        if (static::$toMailCallback) {
//            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
//        }
//
//        return $this->buildMailMessage($this->resetUrl($notifiable));
    }

//    protected function buildMailMessage($url)
//    {
//        return (new MailMessage)
//            ->subject(Lang::get('Reset Password Notification'))
//            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
//            ->action(Lang::get('Reset Password'), $url)
//            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
//            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
//    }

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
