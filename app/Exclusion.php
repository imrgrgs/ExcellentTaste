<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Exclusion extends Model
{
    protected $fillable = [
        'start',
        'end'
    ];

    public function excluded()
    {
        return $this->morphTo();
    }

    public function getCarbonStartAttribute()
    {
        return Carbon::parse($this->start);
    }

    public function getCarbonEndAttribute()
    {
        return Carbon::parse($this->end);
    }
}
