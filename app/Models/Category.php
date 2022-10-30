<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the subcategories for the Category.
     */
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    /**
     * Get all of the products for the category.
     */
    public function products()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }
}
