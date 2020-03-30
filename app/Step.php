<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $guarded = [];

    public function cell()
    {
        return $this->belongsTo('App\Cell');
    }
}
