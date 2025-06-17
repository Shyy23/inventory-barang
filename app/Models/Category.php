<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name'];
    public $timestamps = false;
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
