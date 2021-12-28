<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = file('database/seed_data/products.csv');
        array_shift($arr);
        foreach ($arr as $product) {
            $split = explode(';', $product);
            Product::firstOrCreate([
                'id' => $split[0],
                'name' => $split[1],
                'price' => $split[2],
                'description' => $split[3]
            ]);
        }
    }
}
