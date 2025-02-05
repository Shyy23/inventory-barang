<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = ['user_id', 'name', 'nisn', 'gender', 'class_id', 'phone_number', 'address'];
    public $timestamps = false;

}
