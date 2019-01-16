<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exclusion extends Model
{
    protected $fillable = [
        'start',
        'end'
    ];

    public function excludeable()
    {
        return $this->morphTo('excluded_id', 'excluded_type');
    }
}
