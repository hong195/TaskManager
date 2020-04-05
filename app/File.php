<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    public function filable()
    {
        return $this->morphTo();
    }


    public function term()
    {
       return $this->hasOne('App\Term', 'term_id');
    }

    public function cell(){
        return $this->hasOne('App\Cell', 'cell_id');
    }
}
