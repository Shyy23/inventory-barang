<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    protected $fillable = ['level', 'major', 'abc_id', 'location_id'];
    public $timestamps = false;

}
