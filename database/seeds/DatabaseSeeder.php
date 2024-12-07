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
            'password' => bcrypt('76037fae-10c7-406f-81de-18c0582de98e'),
            'role' => 'admin'
        ]);
    }
}
