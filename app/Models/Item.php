<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $fillable = ['item_name', 'category_id', 'slug_item','location_id', 'stock', 'description', 'image', 'status', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function item_loan()
    {
        return $this->hasMany(LoanDetail::class, 'item_id', 'item_id');
    }
}
