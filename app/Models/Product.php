<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the subcategory that owns the category.
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
