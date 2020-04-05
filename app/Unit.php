<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //

    protected $guarded =[];

    public function logo (){
        return $this->morphOne('App\File', 'filable');
    }


    public function sections()
    {
        return $this->hasMany('\App\Section','bu_id');
    }

    public function departments()
    {
        return $this->hasMany('\App\Department', 'bu_id');
    }

    public function users() {
        return $this->hasMany('\App\User', 'company_id');
    }

}
