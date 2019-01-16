<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function exclusions()
    {
        return $this->morphMany('App\Exclusion', 'excluded');
    }
}
