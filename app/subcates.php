<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcates extends Model
{
    //
    protected $table = "subcates";
    public function cates()
    {
    	return $this->belongsTo('App\cates','id_cates','id');
    }
    public function products()
    {
    	return $this->hasMany('App\products','id_subcates','id');
    }
}
