<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date',
        'number',
        'diet'
    ];

    public function tables()
    {
        return $this->belongsToMany(Table::class, 'reservation_tables')->withPivot('start', 'end');
    }
}
