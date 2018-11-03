<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
     protected $table ="products";
   
      public function subcates()
    {
    	return $this->belongsTo('App\subcates','id_subcates','id');
    }
    public function products_news()
    {
    	return $this->hasMany('App\products_news','id_products','id');
    }
    public function danhgias()
    {
    	return $this->hasMany('App\danhgia','id_products','id');
    }
    public function comments()
    {
    	return $this->hasMany('App\comment','id_products','id');
    }
    public function bill_detail()
    {
    	return $this->hasMany('App\bill_details','id_products','id');
    }
     public function giasps()
    {
        return $this->belongsTo('App\giasp','id_giasp','id');
    }
    public function mul_image()
    {
        return $this->hasMany('App\mul_image','id_products','id');
    }

      public function phukiens()
    {
        return $this->belongsToMany('App\phukien')->withPivot('id');
    }
    public function edit_products()
    {
        return $this->hasMany('App\edit_products','id_products','id');
    }
}
