<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replies extends Model
{
    //
    protected $table ="replies";
    public function user()
    {
        return $this->beLongsTo('App\User','id_user','id');
    }

    public function comment() {
    	return $this->belongsTo('App\comments', 'id_comment', 'id');
    }
}
