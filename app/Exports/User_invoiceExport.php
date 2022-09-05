<?php

namespace App\Exports;

use App\Models\invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
class User_invoiceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
     // varible form and to 
     public function __construct(String $user_id = null , String $invoiceId = null , String $date = null)
     {
         $this->user_id = Auth::user()->id;
         $this->invoiceId   = $invoiceId;
         $this->date   = $date;
     }

    public function headings():array{
        return [
            'ID',
            'Due Date',
            'Invoice ID',
            'Invoice Document',
            'Amount'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return invoice::all();
        return invoice::select('id','date','invoiceId','invoice_doc','amount')
        ->where('user_id','like','%'.$this->user_id.'%')
        ->where('invoiceId','like','%'.$this->invoiceId.'%')
        ->where('date','like','%'.$this->date.'%')
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
