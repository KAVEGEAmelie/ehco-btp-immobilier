<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DebugAdminSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Vider la table users
        DB::table('users')->truncate();
        
        // Créer l'administrateur principal avec une méthode directe
        DB::table('users')->insert([
            'name' => 'Administrateur Debug',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'main_admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Vérifier que l'utilisateur a été créé
        $user = User::where('email', 'admin@test.com')->first();
        
        if ($user) {
            echo "✅ Utilisateur créé avec succès:\n";
            echo "- Email: {$user->email}\n";
            echo "- Rôle: {$user->role}\n";
            echo "- Password Hash: " . substr($user->password, 0, 20) . "...\n";
        } else {
            echo "❌ Erreur: Utilisateur non créé\n";
        }
    }
}
