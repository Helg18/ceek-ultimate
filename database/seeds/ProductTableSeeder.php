<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
        	'title' => 'ceeker vr headset',
        	'cat_id' => 1,       	
        	'image' => 'headset-vr-ceek.jpg',
        	'description' => 'Headset + 1 year Free Access to CEEK VR library',
        	'price' => 99
        ]);

        $product->save();

        $product = new \App\Product([
        	'title' => 'megadeth vr concert',        	
        	'cat_id' => 2,
        	'image' => 'megadeth-cardbox-vr.png',
        	'description' => 'Megadeth VR Concert Access + cardbox headset',
        	'price' => 9.99
        ]);

        $product->save();
    }
}
