<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    public function unit()
    {
        return $this->hasOne('\App\Unit', 'bu_id');
    }

    public function term()
    {
       return $this->hasOne('App\Term', 'term_id');
    }

    public function cell(){
        return $this->hasOne('App\Cell', 'cell_id');
    }
}
