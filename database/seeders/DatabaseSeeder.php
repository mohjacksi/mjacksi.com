<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::query()->create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@admin.com',
        ]);
    }
}
