<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    protected $table = 'loan_logs';
    protected $primaryKey = 'loan_id';
    protected $fillable = ['student_id', 'loan_status', 'loan_status', 'loan_date', 'return_time', 'approved_by'];
    public $timestamps = false;

}
