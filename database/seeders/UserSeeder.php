<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test Test',
            'email' => 'test@gmail.com',
            'phone' => fake()->phoneNumber(),
            'password' => Hash('sha1', '12345'),
            'real_password' => 12345,
        ]);
    }
}
