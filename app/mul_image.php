<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mul_image extends Model
{
    //
    protected $table = "mul_images";
    public function products()
    {
        return $this->hasMany('App\products','id_products','id');
    }
}
