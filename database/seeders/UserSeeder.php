<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): User
    {
         return App\Models\User::create([
            'name' => 'shahrokhi',
            'email' => 'shahrokhi@yahoo.com',
            'password' => Illuminate\Support\Facades\Hash::make('shahrokhi123456789'),

        ]);
    }
}
