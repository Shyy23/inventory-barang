<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    protected $table = 'loan_logs';
    protected $primaryKey = 'loan_log_id';
    protected $fillable = [
        'user_id', 'loan_id', 'action', 'level', 'details', 'ip_address'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
