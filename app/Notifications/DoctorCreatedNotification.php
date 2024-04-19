<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorCreatedNotification extends Notification
{
    use Queueable;
    public $doctor;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'type' => 'doctor_created',
    //         'message' => 'A new doctor has been added !',
    //         'action' => '/doctor',
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'A new doctor has been added!',
            'doctor_name' => $this->doctor['first_name'].$this->doctor['middle_name'].$this->doctor['last_name'],
            'doctor_email' => $this->doctor['emai'],
            'doctor_phone' => $this->doctor['phone'],
            'doctor_profile' => $this->doctor['profile'],
        ];
    }
}
