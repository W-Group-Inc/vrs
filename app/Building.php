<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use SoftDeletes;

    protected $table = "buildings";
}
