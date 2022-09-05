<?php

namespace App\Exports;

use App\Models\invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\DebitNote;
class DebitNotes implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
     // varible form and to 
     public function __construct(String $user_id = null , String $do_no = null)
     {
         $this->user_id = $user_id;
         $this->do_no   = $do_no;
     }

    public function headings():array{
        return [
            'Customer Name',
            'D0 Number',
            'DN Number',
            'DN Date',
            'Payment Term'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return invoice::all();
        return DebitNote::Select('users.name', 'delivery_orders.do_no', 'debit_notes.dn_no', 'debit_notes.dn_date', 'debit_notes.payment_term')
        ->leftjoin('delivery_orders', Array('delivery_orders.id' => 'debit_notes.deliveryorder_id'))
        ->leftjoin('users', Array('users.id' => 'debit_notes.user_id'))
        ->where('debit_notes.user_id','like','%'.$this->user_id.'%')
        ->where('delivery_orders.do_no','like','%'.$this->do_no.'%')

        // return invoice::select('id','date','invoiceId','invoice_doc','amount')
        // ->where('user_id','like','%'.$this->user_id.'%')
        // ->where('invoiceId','like','%'.$this->invoiceId.'%')
        // ->where('date','like','%'.$this->date.'%')
        ->get();  
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
