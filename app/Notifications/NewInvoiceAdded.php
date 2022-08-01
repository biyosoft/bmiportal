<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInvoiceAdded extends Notification
{
    use Queueable;
    public $admin_user;
    public $invoices ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($admin_user,$invoices)
    {
        $this->admin_user = $admin_user;
        $this->invoices = $invoices;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'admin_id' => $this->admin_user->id,
            'admin_name' => $this->admin_user->name,
            'invoice_id' => $this->invoices->id,
            'invoice_invoiceId' => $this->invoices->invoiceId,
        ];
    }
}
