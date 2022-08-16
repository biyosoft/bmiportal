<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invoice_id = $this->invoices->id;
        $admin_id = $this->admin_user->id;
        return (new MailMessage)
        
                    ->line(new HtmlString('Invoice '.'<a href="http://bmiportal.com/invoices/show/'.$invoice_id.'">'.$this->invoices->invoiceId.'</a>'.' has been added by '.'<b>'.$this->admin_user->name.'</b>' ));
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
