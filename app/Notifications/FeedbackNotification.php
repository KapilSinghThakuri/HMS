<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $validatedData;

    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
            ->subject('New User Feedback Received!')
            ->line('A new user feedback message has been received. Here are the details:')
            ->line("**Full Name:** {$this->validatedData['fullname']}")
            ->line("**Email:** {$this->validatedData['email']}")
            ->line("**Subject:** {$this->validatedData['subject']}")
            ->line("**Message:**")
            ->line($this->validatedData['message'])
            ->line('Thank you for taking the time to review this feedback.')
            ->action('Go to Admin Dashboard', url('/Healwave/admin/dashboard'));
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
            'method' => 'feedback_alert',
            'subject' => 'New User Feedback',
            'fullname' => $this->validatedData['fullname'],
            'email' => $this->validatedData['email'],
            'feedback_subject' => $this->validatedData['subject'],
            'feedback_message' => $this->validatedData['message'],
            'action_url' => url('/Healwave/admin/dashboard'),
        ];
    }
}
