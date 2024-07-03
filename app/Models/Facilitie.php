<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facilitie extends Model
{
    use HasFactory;
            /**
     * Get all of the comments for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function products(): HasMany
    // {
    //     return $this->hasMany(Product::class, 'id_produk', 'id');
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
