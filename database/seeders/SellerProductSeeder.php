<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $sellers = Seller::all();
        foreach ($products as $product) {
            // Verifica se il film ha già dei generi associati
            if ($product->sellers()->exists()) {
            continue; 
            }
            $numSellers = rand(2, 5);
            $selectedSellers = $sellers->random($numSellers);
            foreach ($selectedSellers as $seller) {
                $product->sellers()->attach($seller->id,
                    [
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
            }
        }
    }
}
