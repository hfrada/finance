<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['root', 'editor'];

        foreach ($name as $key)
            Role::insert([
                'access_name' => $key,
                'permission' => ($key != 'root') ? ' ' : 'financial, category'
            ]);
    }
}
