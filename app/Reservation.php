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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalPriceAttribute()
    {
        $total = 0;
        foreach ($this->orders as $order) {
            $total += $order->products->sum('pivot.payed');
        }
        return $total;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
