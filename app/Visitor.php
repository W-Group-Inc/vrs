<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    //
    protected $table = "visitors";

    public function location()
    {
        return $this->belongsTo(Building::class);
    }
}
