<?php

use App\Room;
use App\User;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create administrator user
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@yourrooms.com',
            'is_admin' => true,
        ]);

        // Create default rooms
        Room::create([
            'name' => '🧪 Pruebas',
            'slug' => 'pruebas',
            'description' => 'Sala para realizar pruebas.',
            'limit' => 2,
            'active' => true,
        ]);
        Room::create([
            'name' => '🎉 Entretenimiento',
            'slug' => 'entretenimiento',
            'description' => 'Esta sala es para hablar sobre entretenimiento: eventos, fiestas, juegos, concursos, y compartir historias divertidas.',
            'limit' => 200,
            'active' => true,
        ]);
        Room::create([
            'name' => '❤️ Amor',
            'slug' => 'amor',
            'description' => 'En esta sala se puede hablar sobre amor, relaciones, citas, y consejos sentimentales.',
            'limit' => 450,
            'active' => true,
        ]);
        Room::create([
            'name' => '💻 Tecnología',
            'slug' => 'tecnologia',
            'description' => 'Esta sala es para hablar sobre tecnología: novedades, gadgets, aplicaciones, consejos y trucos, y compartir experiencias.',
            'limit' => 100,
            'active' => true,
        ]);
        Room::create([
            'name' => '💪 En Forma',
            'slug' => 'en-forma',
            'description' => 'Esta sala es para hablar sobre deporte y ejercicio: rutinas, dietas, consejos de entrenamiento, y compartir logros y objetivos.',
            'limit' => 150,
            'active' => true,
        ]);
        Room::create([
            'name' => '🍴 Cocina',
            'slug' => 'cocina',
            'description' => 'En esta sala se puede hablar sobre cocina: recetas, trucos culinarios, consejos, y compartir fotos de deliciosos platillos.',
            'limit' => 100,
            'active' => true,
        ]);
        Room::create([
            'name' => '🎶 Música',
            'slug' => 'musica',
            'description' => 'En esta sala se puede hablar sobre música: géneros, artistas, conciertos, festivales, y compartir canciones y playlists.',
            'limit' => 100,
            'active' => true,
        ]);
        Room::create([
            'name' => '🎮 Videojuegos',
            'slug' => 'videojuegos',
            'description' => 'Esta sala es para hablar sobre videojuegos: consolas, juegos, estrategias, y compartir opiniones y recomendaciones.',
            'limit' => 120,
            'active' => true,
        ]);
        Room::create([
            'name' => '🤪 De todo un poco',
            'slug' => 'de-todo-un-poco',
            'description' => 'En esta sala se puede hablar de cualquier cosa: temas de actualidad, memes, noticias curiosas, y compartir historias divertidas.',
            'limit' => 450,
            'active' => true,
        ]);
        Room::create([
            'name' => '💬 Amistad 👥',
            'slug' => 'amistad',
            'description' => 'Esta sala está diseñada para hacer amigos. Conoce a gente nueva, comparte tus intereses y aficiones, y descubre nuevas culturas y formas de pensar.',
            'limit' => 450,
            'active' => true,
        ]);
        Room::create([
            'name' => '🌐 Idiomas 📚',
            'slug' => 'idiomas',
            'description' => 'Esta sala es para hablar de idiomas y practicar con otros miembros. Aprenda nuevos idiomas, comparta consejos y trucos, y descubra nuevas culturas y formas de pensar.',
            'limit' => 300,
            'active' => true,
        ]);
        Room::create([
            'name' => '🌮 México 🍛',
            'slug' => 'mexico',
            'description' => 'Esta sala de chat es ideal para los amantes de la cultura y actualidad de México. Los participantes pueden conversar sobre temas como la gastronomía, turismo, tradiciones, música, entre otros. Además, se pueden compartir noticias y opiniones sobre la situación actual del país. También es una buena oportunidad para conocer gente de diferentes partes de México y compartir experiencias culturales.',
            'limit' => 450,
            'active' => true,
        ]);
        Room::create([
            'name' => '👥 1 a 1',
            'slug' => '1-a-1',
            'description' => 'La sala de chat 1 a 1 es un espacio ideal para conversaciones privadas entre dos personas. Aquí, los participantes pueden hablar sobre cualquier tema que deseen, sin interrupciones de terceros. Es perfecta para establecer conexiones personales, ya sea para discutir temas profesionales o simplemente para hacer amigos. Esta sala de chat es un lugar seguro y privado para compartir pensamientos e ideas.',
            'limit' => 2,
            'active' => true,
        ]);
    }
}
