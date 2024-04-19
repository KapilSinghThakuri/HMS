<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScheduleCreatedNotification extends Notification
{
    use Queueable;
    public $schedule;
    public $doctor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($schedule, $doctor, $method)
    {
        $this->schedule = $schedule;
        $this->doctor = $doctor;
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
            'scheduled_day' => $this->schedule['in'],
            'scheduled_time_from' => $this->schedule['from'],
            'scheduled_time_to' => $this->schedule['to'],
            'doctor_name' => $this->doctor['first_name'].$this->doctor['middle_name'].$this->doctor['last_name'],
            'doctor_email' => $this->doctor['emai'],
            'doctor_phone' => $this->doctor['phone'],
            'doctor_profile' => $this->doctor['profile'],
        ];
    }
}
