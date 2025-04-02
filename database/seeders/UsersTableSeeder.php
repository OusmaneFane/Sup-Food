<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Désactive les événements pour optimiser les performances
        User::withoutEvents(function () {
            
            // 1. Super Admin (Accès complet)
            User::create([
                'name' => 'Super Admin SupFood',
                'email' => 'superadmin@supfood.com',
                'password' => Hash::make('SuperPass123'),
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ]);

            // 2. Admin (Gestion globale)
            User::create([
                'name' => 'Admin Campus',
                'email' => 'admin@supfood.com',
                'password' => Hash::make('AdminPass123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);

            // 3. Gestionnaires (Gestion quotidienne)
            $managers = [
                [
                    'name' => 'Gestionnaire Cafétéria',
                    'email' => 'gestionnaire@supfood.com',
                    'password' => Hash::make('GestPass123'),
                    'role' => 'gestionnaire',
                ],
                [
                    'name' => 'Responsable Commandes',
                    'email' => 'commandes@supfood.com',
                    'password' => Hash::make('GestPass123'),
                    'role' => 'gestionnaire',
                ]
            ];

            foreach ($managers as $manager) {
                User::create($manager);
            }

            // 4. Étudiants (Clients)
            $students = [
                [
                    'name' => 'Étudiant Alpha Diallo',
                    'email' => 'etudiant1@supfood.com',
                    'password' => Hash::make('StudentPass'),
                    'role' => 'etudiant',
                ],
                [
                    'name' => 'Étudiante Aïssata Diop',
                    'email' => 'etudiant2@supfood.com',
                    'password' => Hash::make('StudentPass'),
                    'role' => 'etudiant',
                ],
                [
                    'name' => 'Étudiant Modou Fall',
                    'email' => 'etudiant3@supfood.com',
                    'password' => Hash::make('StudentPass'),
                    'role' => 'etudiant',
                ]
            ];

            foreach ($students as $student) {
                User::create($student);
            }

            // Optionnel : Génération d'étudiants aléatoires
            User::factory()->count(15)->create([
                'role' => 'etudiant',
                'password' => Hash::make('StudentPass')
            ]);
        });

        $this->command->info('Seeder UsersTableSeeder exécuté avec succès !');
        $this->command->info('Super Admin : superadmin@supfood.com / SuperPass123');
        $this->command->info('Étudiant Test : alpha.etudiant@supfood.com / StudentPass1');
    }
}