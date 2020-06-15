<?php

use Illuminate\Database\Seeder;

class SuperUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\SuperUsers::class, 10)->create();
    }
}
