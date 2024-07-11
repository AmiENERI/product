<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $types = Type::all();
        foreach ($products as $product) {
            // Verifica se il film ha già dei generi associati
            if ($product->types()->exists()) {
            continue; 
            }
            $numTypes = rand(1, 3);
            $selectedTypes = $types->random($numTypes);
            foreach ($selectedTypes as $type) {
                $product->types()->attach($type->id,
                    [
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
            }
        }
    }
}
