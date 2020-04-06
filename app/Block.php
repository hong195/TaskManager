<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $guarded = [];

    public function cells()
    {
        return $this->hasMany('\App\Cell', 'block_id');
    }

    public function department() {
        return $this->belongsTo('\App\Department', 'dep_id');
    }
}
