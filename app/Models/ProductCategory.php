<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 
    ];    

    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }
}
