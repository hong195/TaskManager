<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms';

    public function file() {
        return $this->hasOne('App\File', 'term_id');
    }
}
