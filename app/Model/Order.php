<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        "name_customer",
        "address_customer",
        "phone_number_customer",
        "prezzo_totale",
        "data"
    ];
    public function user(){
        return $this->belongsTo("App\User");
    }

    public function dish(){
        return $this->hasMany("App\Model\Dish");
    }
}
