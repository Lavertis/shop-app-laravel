<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = file('database/seed_data/countries.csv');
        array_shift($arr);
        foreach ($arr as $country) {
            $split = explode(';', $country);
            Country::firstOrCreate([
                'code' => $split[0],
                'name' => $split[1],
            ]);
        }
    }
}
