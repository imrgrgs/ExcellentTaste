<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
