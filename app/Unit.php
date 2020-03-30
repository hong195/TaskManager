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

    public function departments()
    {
        return $this->hasMany('\App\Department', 'bu_id');
    }

    public function users() {
        return $this->hasMany('\App\User', 'company_id');
    }

}
