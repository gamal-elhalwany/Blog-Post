<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostStatusNotification extends Notification
{
    use Queueable;
    protected $post;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $status)
    {
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // If You Chose More than one channel then you have to set up it's configurations unlis you'll have errors.

        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage);
        // ->subject("Post Status has been Updated.")
        // ->greeting("Hello {$notifiable->name}")
        // ->line("Your Post Status has been updated to " . $this->status)
        // ->action('Back to the main page!', url('/'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'header' => 'Hello ' . $notifiable->name . ' Your Post Status has been updated',
            'body' => 'Your post ' . $this->post->title . ' status has been updated to ' .  $this->status,
            'post' => $this->post->title,
        ];
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
