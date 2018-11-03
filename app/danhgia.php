<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    //
    protected $table ="danhgias";
    public function products()
    {
    	return $this->belongsTo('App\products','id_products','id');
    }
    public function reply()
    {
    	return $this->hasMany('App\replies','id_comment','id');
    }
    public function reply_danhgia()
    {
        return $this->hasMany('App\reply_danhgia','id_danhgia','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
}
