<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function file() {
        return $this->morphOne('App\File', 'filable');
    }
}
