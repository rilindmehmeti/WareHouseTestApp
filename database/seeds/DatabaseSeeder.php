<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@warehouse.com',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ]);

    }
}
