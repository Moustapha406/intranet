<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => 'passer',
            'nom' => 'Admin',
            'prenom' => 'Administrateur',
            'genre' => 'Homme',
            'site' => 'Siege',
            'departement' => 'Appro',
            'fonction' => 'appro',
            'is_active' => true
        ]);
    }
}
