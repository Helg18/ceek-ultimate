<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = new \App\Categories([
        	'mid' => 'a',
        	'description' => 'Testing cate one',
        	'name' => 'cate one'
        ]);

        $categories->save();

        $categories = new \App\Categories([
        	'mid' => 'b',
        	'description' => 'testing cate two',
        	'name' => 'cate two'
        ]);

        $categories->save();
    }
}
