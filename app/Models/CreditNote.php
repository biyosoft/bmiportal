<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    use HasFactory;
    protected $dates= ['cn_date','payment_term'];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function deliveryorder(){
        return $this->belongsTo(DeliveryOrder::class)->withDefault();
    }
}
