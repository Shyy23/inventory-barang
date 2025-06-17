<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $table = 'security_logs';
    protected $primaryKey = 'security_log_id';
    protected $fillable = [
        'email',
        'action',
        'level',
        'success',
        'ip_address',
        'details'
    ];
}
