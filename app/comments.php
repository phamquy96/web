<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model //WTF Tên MOdel, quỳ
{
    //
    protected $table= "comments";

    public function products()
    {
    	return $this->belongsTo('App\products','id_products','id');
    }
    public function products_news()
    {
    	return $this->belongsTo('App\products_news','id_products_news','id');
    }
    public function replies() //quy ước ở đây là viết số nhiều nhé e 
    {
    	return $this->hasMany('App\replies','id_comment','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
}
