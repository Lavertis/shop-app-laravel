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
            'code' => 'visa',
            'name' => 'Visa'
        ]);
        PaymentMethod::firstOrCreate([
            'code' => 'mastercard',
            'name' => 'MasterCard'
        ]);
        PaymentMethod::firstOrCreate([
            'code' => 'transfer',
            'name' => 'Bank transfer'
        ]);
    }
}
