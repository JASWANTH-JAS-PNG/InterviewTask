<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@bloghub.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@bloghub.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
