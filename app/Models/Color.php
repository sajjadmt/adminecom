<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function carts()
    {
        return $this->hasMany(CartList::class);
    }

}
