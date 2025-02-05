<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['nomor_induk', 'role', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];
    public $timestamps = true;

}
