<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description', 'photo', 'producer_id', 'price'];

    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
}
