<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['Name', 'Desc', 'Quantity', 'Unit', 'Category_id', 'Supplier_id', 'Price', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'Supplier_id');
    }
}

