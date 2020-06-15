<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$category = ['shopping', 'hobbies', 'saving', 'banking', 'food', 'vacation', 'transfer', 'gift/present', 'salary', 'profit', 'other'];
        foreach ($category as $cat) Category::insert(['category' => $cat]);
    }
}
