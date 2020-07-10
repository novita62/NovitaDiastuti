<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username' => 'admin',
            'nama' => 'Admin',
            'password' => bcrypt('admin'),
            'role' => 1,
            'remember_token' => Str::random(10)
        ]);
    }
}
