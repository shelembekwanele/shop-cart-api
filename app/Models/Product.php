<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'in_stock', 'description', 'image_url'];
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }
}
