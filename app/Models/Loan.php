<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $fillable = ['nisn', 'loan_status', 'loan_type', 'is_approved','loan_date', 'due_date', 'approved_by'];
    public $timestamps = true;
    protected $casts = [
        'updated_at' => 'datetime',
    ];


}
