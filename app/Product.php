<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function CalculatePrice($id, $amount)
    {
        $product = Product::find($id)->first();

        return $product->price * $amount;
    }
}
