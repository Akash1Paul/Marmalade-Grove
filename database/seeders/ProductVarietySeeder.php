<?php

namespace Database\Seeders;

use App\Models\ProductVariety;
use Illuminate\Database\Seeder;

class ProductVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varietiesArr = [
            '"SUNRISE" PIXIE TANGERINE MARMALADE',
            'CARA CARA & HIBISCUS MARMALADE',
            'MEYER LEMON & HONEY MARMALADE',
            'MARMALADE GIFT SET',
            'VALENCIA ORANGES',
            'PIXIE TANGERINES',
            'PONY PIXIES',
            'GOLDEN NUGGET TANGERINES',
            'OROBLANCO GRAPEFRUIT',
            'TANGO TANGERINES',
            'SATSUMA MANDARINS',
            'BACON AVOCADO',
            'NAVEL ORANGES',
            'CARA CARA ORANGES',
            'MEYER LEMONS'
        ];

        foreach ($varietiesArr as $variety) {
            ProductVariety::create(
                [
                    'product_name' => $variety,
                ]
            );
        }
    }
}
