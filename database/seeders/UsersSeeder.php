<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@aiqfome.com.br'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Me_contrata_ai@123'),
            ]
        );
        $admin->syncRoles(['admin']);

        // Client
        $client = User::firstOrCreate(
            ['email' => 'client@aiqfome.com.br'],
            [
                'name' => 'Client',
                'password' => Hash::make('Me_contrata_ai@123'),
            ]
        );
        $client->syncRoles(['client']);
    }
}
