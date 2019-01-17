<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function excluded()
    {
        return $this->morphMany('App\Exclusion', 'excluded');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_tables')->withPivot('start', 'end');
    }
}
