<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('StudentPass'), // Mot de passe par défaut
            'role' => 'etudiant', // Valeur par défaut
            'remember_token' => Str::random(10),
        ];
    }

    // États personnalisés pour les différents rôles
    public function superadmin()
    {
        return $this->state([
            'email' => 'superadmin' . rand(1,99) . '@supfood.com',
            'role' => 'superadmin',
            'password' => Hash::make('SuperPass123'),
        ]);
    }

    public function admin()
    {
        return $this->state([
            'role' => 'admin',
            'password' => Hash::make('AdminPass123'),
        ]);
    }

    public function gestionnaire()
    {
        return $this->state([
            'role' => 'gestionnaire',
            'password' => Hash::make('GestPass123'),
        ]);
    }
}