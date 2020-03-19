<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $guarded = [];


    public function steps()
    {
        return $this->hasMany('\App\Step', 'cell_id');
    }
}
