<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    //
    protected $table = "bills";
    
    public function bill_details()
    {
    	return $this->hasMany('App\bill_details','id_bill','id');
    }
    public function customer()
    {
    	return $this->hasOne('App\customers','id_customer','id');
    }
}
