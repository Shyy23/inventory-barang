<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abc extends Model
{
    protected $table = 'abcs';
    protected $primaryKey = 'abc_id';
    protected $fillable = ['abc_name'];
    public $timestamps = false;
}
