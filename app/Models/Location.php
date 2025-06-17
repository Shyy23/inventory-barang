<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_name', 'type'];
    public $timestamps = false;

}
