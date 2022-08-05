<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(payment::class);
    }
}
    