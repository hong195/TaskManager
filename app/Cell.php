<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Cell extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visualisation_date' => 'datetime',
        'plan_deadline' => 'datetime',
        'fact_start_date' => 'datetime',
        'fact_deadline' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function steps()
    {
        return $this->hasMany('\App\Step', 'cell_id');
    }

    /**
     * @return BelongsTo
     */
    public function block() {
        return $this->belongsTo('\App\Block');
    }

    /**
     * @return MorphMany
     */
    public function files() {
        return $this->morphMany('App\File', 'filable');
    }

    /**
     * @return Department
     */
    public function department()
    {
        return $this->block->department;
    }

    public function unit()
    {
        return $this->department()->unit;
    }
}
