<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassLoan extends Model
{
    protected $table = 'class_loans';
    protected $primaryKey = 'class_loan_id';
    protected $fillable = ['load_id', 'class_id', 'subject_id'];
    public $timestamps = false;

}
