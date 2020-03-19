<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //

    protected $guarded =[];

    public function logo (){
        return $this->hasOne('\App\File', 'bu_id');
    }


    public function sections()
    {
        return $this->belongsToMany('\App\Section', 'unit_section');
    }
}
