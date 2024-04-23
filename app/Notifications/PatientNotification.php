<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $patient;
    public $status;
    public $appointment;
    public $schedule;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($patient, $status, $appointment, $schedule)
    {
        $this->status = $status;
        $this->patient = $patient;
        $this->appointment = $appointment;
        $this->schedule = $schedule;
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
     $mailMessage = new MailMessage;

     if ($this->status == 'appointment_approved') {
            $mailMessage->subject('Your Appointment is Approved')
                ->greeting('Hello!'. $this->patient['fullname'])
                ->line('We are pleased to inform you that your appointment has been approved!')
                ->line('Your scheduled appointment is on' . $this->schedule['in'] . 'at' . $this->appointment['time_interval'].'.')
                ->line('Please make sure to bring any necessary documents and arrive a few minutes early.')
                ->action('View Appointment Details', url('/'))
                ->line('We look forward to seeing you!')
                ->salutation('Best regards,')
                ->line('Healwave Clinic.');

        } elseif ($this->status == 'appointment_cancelled') {
            $mailMessage->subject('Your Appointment has been Canceled')
                        ->greeting('Hello,' . $this->patient['fullname'])
                        ->line('We regret to inform you that your appointment has been cancelled.')
                        ->line('Unfortunately, due to doctor personal reason, we had to cancel your appointment.')
                        ->action('Reschedule Your Appointment', url('/'))
                        ->line('We apologize for the inconvenience and invite you to reschedule at your earliest convenience.')
                        ->line('If you have any questions, please contact us.')
                        ->salutation('Best regards,')
                        ->line('Healwave Clinic.');
        }

        return $mailMessage;
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
