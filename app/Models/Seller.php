<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'zip_code', 'town', 'city', 'state', 'telephone', 'email', 'website'];

    public function products()
    {
    return $this->belongsToMany(Product::class);
    }
}
