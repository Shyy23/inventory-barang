<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $table = 'loan_details';
    protected $primaryKey = 'detail_id';
    protected $fillable = ['loan_id', 'item_id', 'item_id', 'unit_id', 'item_quantity', 'loan_description'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
