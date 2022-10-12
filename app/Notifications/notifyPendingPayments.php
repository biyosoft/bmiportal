<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Console\Commands\invoiceReminder;

class notifyPendingPayments extends Notification
{
    public $diffindays;
    public $due_date;
    public $invoice_id;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($diffindays,$due_date,$invoice_id)
    {
        $this->diffindays = $diffindays;
        $this->due_date = $due_date;
        $this->invoice_id = $invoice_id;
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
                    ->line('Invoice NO : ' . $this->invoice_id)
                    ->line('Due Date : ' . $this->due_date);
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
