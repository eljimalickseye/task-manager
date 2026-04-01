<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Création d'un utilisateur de test (optionnel si déjà créé)
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ]);

        // Création de tâches réalistes
        \App\Models\Task::create([
            'title' => 'Initialiser le Dashboard Analytique',
            'description' => 'Mise en place de Chart.js et des widgets de statistiques globales.',
            'completed' => true,
            'priority' => 'high',
            'category' => 'Développement',
            'due_at' => now()->subDays(2),
        ]);

        \App\Models\Task::create([
            'title' => 'Préparer le Pitch de l\'Entretien',
            'description' => 'Réviser les points clés de l\'architecture Laravel et du design SaaS.',
            'completed' => false,
            'priority' => 'high',
            'category' => 'Professionnel',
            'due_at' => now()->addHours(3),
        ]);

        \App\Models\Task::create([
            'title' => 'Optimiser le SEO de l\'application',
            'description' => 'Vérifier les balises Meta et la structure sémantique du HTML.',
            'completed' => false,
            'priority' => 'medium',
            'category' => 'Marketing',
            'due_at' => now()->addDays(5),
        ]);

        \App\Models\Task::create([
            'title' => 'Acheter le café',
            'description' => 'Indispensable pour coder toute la nuit !',
            'completed' => true,
            'priority' => 'low',
            'category' => 'Personnel',
            'due_at' => now()->subHours(12),
        ]);

        \App\Models\Task::create([
            'title' => 'Tester le Responsive sur iPhone 15',
            'description' => 'Vérifier que les cartes de tâches sont bien alignées sur petit écran.',
            'completed' => false,
            'priority' => 'medium',
            'category' => 'QA',
            'due_at' => now()->addDay(),
        ]);
    }
}
