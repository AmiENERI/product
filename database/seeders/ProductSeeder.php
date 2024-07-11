<?php

namespace Database\Seeders;


use App\Models\Seller;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::factory()->count(30)->create(); //includiamo i models use App\Models\Actor;
        Producer::factory()->count(30)->create();
        Product::factory()->count(20)->create();
        Type::factory()->count(10)->create();
        $this->call(SellerProductSeeder::class);
        $this->call(ProductTypeSeeder::class);

    }
}
