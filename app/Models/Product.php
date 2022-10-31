<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'description', 'subcategory_id', 'price', 'thumbnail'];

    /**
     * Get the subcategory that owns the category.
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
