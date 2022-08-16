<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class invoice extends Model
{
    use HasFactory;
    protected $dates= ['date'];
    protected $fillable =[
        'user_id',
        'date',
        'invoice_doc',
        'amount'
    ];

    public function user(){
        return $this->belongsTo(user::class)->withDefault();
    }

    public function payment(){
        return $this->hasOne(payment::class)->latest();
    }
    public function deliveryOrder(){
        return $this->hasOne(deliveryOrder::class)->latest();
    }

    public static function getInvoice(){
        $records = DB::table('invoices')->select('id','date','invoiceId','invoice_doc','amount')->get()->toArray();
        return $records;
    }
}
    