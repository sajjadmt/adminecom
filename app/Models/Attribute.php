<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }

}
