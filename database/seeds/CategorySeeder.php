<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$category = ['shopping', 'hobbies', 'saving', 'banking', 'food', 'vacation', 'transfer', 'gift/present', 'salary', 'profit'];
        foreach ($category as $cat) {
        	factory(App\Category::class)->create(['category' => $cat]);
        }
    }
}
