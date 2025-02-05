<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    protected $fillable = ['user_id', 'name', 'nip', 'gender', 'teacher_role', 'phone_number', 'address'];
    public $timestamps = false;

}
