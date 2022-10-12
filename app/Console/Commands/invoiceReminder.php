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
    protected $signature = 'invoice:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is used to remind ';

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
        // dd(config('global')); // global config for days of reminders before duedate
        $global = config('global');
        $users = User::get();
        $invoices = invoice::get();
        foreach($invoices as $invoice){
            // dd(Carbon::now());
            $due_date = $invoice->date;
            $invoice_id = $invoice->invoiceId;
            dd($due_date , $invoice_id);
            $diffindays =Carbon::parse($invoice->date)->diffInDays(Carbon::now());
            // dd($diffindays);
            if(in_array($diffindays , $global)){ ;
                    $users = User::where('id',$invoice->user_id)->get();    
                    Notification::send($users,new notifyPendingPayments($due_date,$invoice_id));
            }
        }
    }

}
