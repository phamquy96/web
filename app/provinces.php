<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinces extends Model
{
    //
    protected $table = "provinces";
    
	public function districts()
    {
    	return $this->hasMany('App\provinces','provice_id','id');
    }
}
