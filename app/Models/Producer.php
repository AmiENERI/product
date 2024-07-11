<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_of_production'];

    public function products()
    {
    return $this->belongsToMany(Product::class);
    }
}
