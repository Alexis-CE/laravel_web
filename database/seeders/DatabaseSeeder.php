<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

    Category::insert([
        ['name' => 'General', 'color' => '#6B7280'],
        ['name' => 'Programación', 'color' => '#2563EB'],
        ['name' => 'Otros', 'color' => '#10B981'],
        ]);

    // Obtener IDs
$admin = User::where('email', 'admin@test.com')->first();
$general = Category::where('name', 'General')->first();
$prog = Category::where('name', 'Programación')->first();
$otros = Category::where('name', 'Otros')->first();

$questions = [
    [
        'user_id' => $admin->id,
        'category_id' => $prog->id,
        'title' => '¿Por qué me sale "Undefined variable" en PHP si ya la declaré?',
        'description' => 'Tengo una variable declarada fuera de una función y dentro me dice que no existe. ¿Cómo le paso variables a una función en PHP?',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $prog->id,
        'title' => 'Error: SQLSTATE[HY000] [2002] Connection refused en Laravel',
        'description' => 'Al correr `php artisan migrate` me lanza este error. Ya revisé el .env y las credenciales están bien.',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $prog->id,
        'title' => '¿Cómo centrar un div horizontal y verticalmente en CSS?',
        'description' => 'He intentado con margin: auto y text-align: center pero no funciona para centrado vertical. ¿Cuál es la forma correcta con Flexbox?',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $prog->id,
        'title' => 'Git: ¿cómo deshacer el último commit sin perder los cambios?',
        'description' => 'Hice commit de más archivos por error. Necesito deshacer el commit pero sin borrar los archivos modificados.',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $general->id,
        'title' => '¿Cuál es la diferencia entre == y === en JavaScript?',
        'description' => 'A veces uso == y a veces === pero no entiendo bien cuándo usar cada uno. ¿Alguien puede explicar con ejemplos?',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $prog->id,
        'title' => 'TypeError: Cannot read properties of undefined (reading "map")',
        'description' => 'Me sale este error en React cuando intento mapear un array que viene de una API. ¿Cómo manejo el estado de carga?',
    ],
    [
        'user_id' => $admin->id,
        'category_id' => $otros->id,
        'title' => '¿Qué editor de código recomiendan para empezar a programar?',
        'description' => 'Soy nuevo en programación y no sé si usar VS Code, Sublime Text o algún otro. ¿Cuál es mejor para aprender?',
    ],
];

foreach ($questions as $q) {
    Question::create($q);
}

    }
}
