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
        
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);
    }
}
