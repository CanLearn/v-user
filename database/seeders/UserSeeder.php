<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): User
    {
         return User::create([
            'name' => 'root',
            'email' => 'root@yahoo.com',
            'password' => static::$password ??= Hash::make('123456789'),

        ]);
    }
}
