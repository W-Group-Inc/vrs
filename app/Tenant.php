<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use SoftDeletes;

    protected $table = "tenants";

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
}
