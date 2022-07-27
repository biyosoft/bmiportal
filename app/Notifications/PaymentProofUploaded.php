<?php

namespace App\Notifications;

use App\Models\invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentProofUploaded extends Notification
{
    use Queueable;
    public $user;
    public $invoices;
    public $payments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$invoices,$payments)
    {
        $this->user = $user;
        $this->invoices = $invoices;
        $this->payments = $payments;
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
            'user_name' =>$this->user->name,
            'user_id' => $this->user->id,
            'admin' =>  $notifiable,
            'invoice_id' => $this->invoices->id ,
            'payment_id' => $this->payments->id,
            'invoice' => $this->invoices->invoiceId,
            
        ];
    }
}
