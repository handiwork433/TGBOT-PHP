<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['tg_user_id' => 100001], [
            'tg_username' => 'demo_user',
            'ref_code' => Str::random(8),
            'locale' => 'ru',
            'timezone' => 'Europe/Prague',
        ]);

        User::updateOrCreate(['tg_user_id' => null, 'email' => 'admin@example.com'], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'ref_code' => Str::random(8),
            'locale' => 'ru',
            'timezone' => 'Europe/Prague',
        ]);
    }
}
