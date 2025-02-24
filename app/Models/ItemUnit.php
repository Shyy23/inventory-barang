<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemUnit extends Model
{
    protected $table = 'item_units';
    protected $primaryKey = 'unit_id';
    protected $fillable = ['item_id', 'unit_name', 'unit_image'];
    public $timestamps = false;

}
