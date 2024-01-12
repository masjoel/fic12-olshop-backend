<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(9)->create();
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'masjoel@gmail.com',
            'password' => Hash::make('123123123'),
            'phone' => '085290724894',
            'roles' => 'admin',
        ]);
    }
}
