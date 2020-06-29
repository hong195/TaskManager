<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Unit extends Model
{
    //
    use HasRelationships;
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

    public function cells()
    {
        return $this->hasManyDeep(
            'App\Cell',
            ['App\Department', 'App\Block'],
            [
                'bu_id', // Foreign key on the "users" table.
                'dep_id',    // Foreign key on the "posts" table.
                'block_id'     // Foreign key on the "comments" table.
            ],
            [
                'id', // Local key on the "countries" table.
                'id', // Local key on the "users" table.
                'id'  // Local key on the "posts" table.
            ]
        );
    }

    public function blocks()
    {
        return $this->hasManyDeep(
            'App\Block',
            ['App\Department'],
            [
                'bu_id',
                'dep_id',
            ],
            [
                'id',
                'id',
            ]
        );
    }
}
