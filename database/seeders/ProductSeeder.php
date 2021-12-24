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
        Product::firstOrCreate([
            'id' => 345451,
            'name' => "Corsair Crystal Series 570X RGB Tempered Glass",
            'description' => "With immaculate tempered glass enclosing the entire chassis, every component of your build is on display for all to see. The CORSAIR Crystal Series 570X provides enough space for virtually any size radiator and support for up to six case fans. With the three included SP120 RGB LED fans and built-in LED controller, you can liven up your build with brilliant lighting effects.",
            'price' => 189.99
        ]);

        Product::firstOrCreate([
            'id' => 519521,
            'name' => "Silver Monkey SMG-450 Fabric",
            'description' => "The Silver Monkey SMG-450 is extremely comfortable and provides maximum comfort during many hours of gaming sessions. Forget about back pain, thanks to the support that supports the entire length of the back and spine. Two adjustable pillows support the lumbar region and the neck.\r\n\r\nYou can adjust the chair to adjust its position to your liking. Therefore, adjust the inclination of the backrest, the height of the seat and the 2D armrests. The appearance of the chair will perfectly match your gaming room.",
            'price' => 130.88
        ]);

        Product::firstOrCreate([
            'id' => 620876,
            'name' => "Gigabyte Z590 AORUS ULTRA",
            'description' => "The Z590 AORUS ULTRA comes with upgraded power solution, all PCIe 4.0 design and outstanding connectivity to elevate your gaming experience to the next level.",
            'price' => 280.00
        ]);

        Product::firstOrCreate([
            'id' => 631886,
            'name' => "GIGABYTE G27QC A 27\"",
            'description' => "GIGABYTE gaming monitors pack upscale performance into a streamlined package. The G27QC provides an immersive experience through fluid gameplay with 1ms response time, 165Hz refresh rate, and AORUS utility software.",
            'price' => 299.99
        ]);

        Product::firstOrCreate([
            'id' => 659168,
            'name' => "LG OLED65C12LA",
            'description' => "A view found nowhere else.\r\nIf you’re looking for a TV like no other, look no further. LG OLED TV is a work of art, a big-screen cinema, a portal to gaming worlds, and a front row seat to the biggest sporting events. It’s everything you want TV to be.",
            'price' => 2500.00
        ]);
    }
}
