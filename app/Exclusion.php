<?php

namespace App;

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
}
