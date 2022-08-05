<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    protected $dates = [
        'date'
    ];
    protected $fillable=[
        'user_id',
        'invoice_id',
        'date',
        'do_no'
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function invoice(){
        return $this->belongsTo(invoice::class)->withDefault();
    }
    
}
