<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(CartList::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

}
