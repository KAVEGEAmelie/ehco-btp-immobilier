<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Créer l'administrateur principal
        User::updateOrCreate(
            ['email' => 'admin@immobilier.com'],
            [
                'name' => 'Administrateur Principal',
                'email' => 'admin@immobilier.com',
                'password' => Hash::make('admin123456'),
                'role' => 'main_admin',
                'email_verified_at' => now(),
            ]
        );

        // Créer un administrateur secondaire
        User::updateOrCreate(
            ['email' => 'admin2@immobilier.com'],
            [
                'name' => 'Administrateur Secondaire',
                'email' => 'admin2@immobilier.com',
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Créer un utilisateur normal pour test
        User::updateOrCreate(
            ['email' => 'user@immobilier.com'],
            [
                'name' => 'Utilisateur Test',
                'email' => 'user@immobilier.com',
                'password' => Hash::make('user123456'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
    }
}
