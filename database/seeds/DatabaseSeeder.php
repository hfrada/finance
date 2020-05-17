<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\User::class, 10)->create();

        $this->call([
            CategorySeeder::class,
            FinancialSeeder::class
        ]);
    }
}
