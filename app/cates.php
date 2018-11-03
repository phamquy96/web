<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cates extends Model
{
    //
    protected $table = "cates";
     public function subcates()
    {
    	return $this->hasMany('App\subcates','id_cates','id');
    }
    public function products()
    {
    	return $this->hasManyThrough('App\products', 'App\subcates', 'id_cates', 'id_subcates', 'id');
    }
    public function phukiens()
    {
        return $this->hasManyThrough('App\phukiens', 'App\subcates', 'id_cates', 'id_subcates', 'id');
    }
}
