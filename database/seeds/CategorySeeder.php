<?php

use Sellout\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = $this->_getCategories();
        foreach($categories as $category)
        {
            Category::create($category);
        }
    }
    private function _getCategories()
    {
        return [
            [
                'description' => 'An adventure story is about a protagonist who journeys to epic or distant places to accomplish something.',
                'name' => 'Adventure'
            ],
            [
                'description' => 'A fantasy story is about magic or supernatural forces, rather than technology, though it often is made to include elements of other genres, such as science fiction elements, for instance computers or DNA, if it happens to take place in a modern or future era.',
                'name' => 'Fantasy'
            ],
            [
                'description' => 'Films that are designed to entertain the audience through amusement, and most often work by exaggerating characteristics of real life for humorous effect.',
                'name' => 'Comedy'
            ],
        ];
    }
}
