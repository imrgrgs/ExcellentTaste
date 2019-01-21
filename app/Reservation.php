<?php

namespace App;

use Carbon\Carbon;
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

    public function getDateStringAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
