<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $table = 'user_activity_logs';
    protected $primaryKey = 'activity_log_id';
    protected $fillable =  ['user_id', 'action', 'level', 'table_name',  'record_id', 'old_data', 'new_data', 'ip_address'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
