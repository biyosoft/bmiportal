<?php

namespace App\Console\Commands;

use App\Models\invoice;
use App\Notifications\notifyPendingPayments;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class invoiceReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::get();
        $invoices = invoice::get();
        foreach($invoices as $invoice){
            //comparing the differnce between the dates
            if(Carbon::parse($invoice->invoice_date)->diffInDays(Carbon::now()) == 7){ 
                foreach($users as $user){
                    Notification::send($user,new notifyPendingPayments());
                }
            }
        }
    }
}
