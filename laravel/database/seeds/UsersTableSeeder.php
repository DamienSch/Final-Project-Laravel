<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'status' => 'admin',
            'email' => 'admin@admin.fr',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'client',
            'status' => 'client',
            'email' => 'client@client.fr',
            'password' => Hash::make('client'),
        ]);
    }
}
