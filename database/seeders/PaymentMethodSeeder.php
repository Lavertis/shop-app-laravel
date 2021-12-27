<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::firstOrCreate([
            'name' => 'visa'
        ]);
        PaymentMethod::firstOrCreate([
            'name' => 'mastercard'
        ]);
        PaymentMethod::firstOrCreate([
            'name' => 'transfer'
        ]);
    }
}
