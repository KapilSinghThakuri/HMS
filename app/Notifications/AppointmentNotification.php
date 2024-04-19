<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;
    public $appointment;
    public $patient;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($appointment, $patient, $method)
    {
        $this->patient = $patient;
        $this->appointment = $appointment;
        $this->method = $method;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'method' => $this->method,
            'appointment_time_interval' => $this->appointment['time_interval'],
            'patient_name' => $this->patient['fullname'],
            'patient_email' => $this->patient['email'],
        ];
    }
}
