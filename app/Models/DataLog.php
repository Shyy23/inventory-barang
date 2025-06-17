<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLog extends Model
{
    protected $table = 'data_logs';
    protected $primaryKey = 'data_log_id';
    protected $fillable = ['user_id', 'table_name', 'record_id', 'action', 'level', 'old_data', 'new_data'];
    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
