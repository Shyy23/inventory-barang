<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const CREATED_AT = 'loan_date';
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $fillable = ['student_id', 'loan_status', 'loan_status', 'loan_date', 'return_time', 'approved_by'];
    public $timestamps = true;
    protected $casts = [
        'updated_at' => 'datetime',
    ];
    

}
