<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    //
     protected $table = "customers";
      public function bill_details()
    {
        return $this->hasManyThrough('App\bill_details', 'App\bills', 'id_customer', 'id_bill', 'id');
    }
     public function bills()
    {
    	return $this->hasMany('App\bills','id_customer','id');
    }
    
}

