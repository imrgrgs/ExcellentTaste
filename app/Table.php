<?php

namespace App;

use Carbon\Carbon;
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

    public function getStartTimeAttribute()
    {
        return Carbon::parse($this->pivot->start)->format('H:m');
    }

    public function getEndTimeAttribute()
    {
        return Carbon::parse($this->pivot->end)->format('H:m');
    }
}
