<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Crear artículos para cada usuario
        foreach ($users as $user) {
            Article::factory(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
