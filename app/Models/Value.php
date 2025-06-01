<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
