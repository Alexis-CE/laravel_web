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

// Respuestas
$answersData = [
    '¿Por qué me sale "Undefined variable" en PHP si ya la declaré?' => [
        'PHP tiene scope de variables. Las variables fuera de una función no son accesibles dentro a menos que uses `global $var` o la pases como parámetro. Lo más limpio es pasarla como argumento: `function miFuncion($variable) { ... }`',
        'También puedes usar `use` en closures: `$fn = function() use ($miVar) { ... };`. Evita `global`, es mala práctica.',
    ],
    'Error: SQLSTATE[HY000] [2002] Connection refused en Laravel' => [
        'Revisa tu `.env`: `DB_HOST=127.0.0.1` debe coincidir con donde corre tu base de datos. Si usas Docker, cambia a `DB_HOST=mysql` (el nombre del servicio). Luego corre `php artisan config:clear`.',
        'También puede ser que MySQL no esté corriendo. En Linux: `sudo systemctl start mysql`. En Windows revisa que el servicio esté activo en el administrador de tareas.',
    ],
    '¿Cómo centrar un div horizontal y verticalmente en CSS?' => [
        'Con Flexbox en el padre: `display: flex; align-items: center; justify-content: center;`. El padre necesita tener altura definida, por ejemplo `height: 100vh` para centrar en pantalla completa.',
        'Con CSS Grid también funciona perfecto: `display: grid; place-items: center;`. Es la forma más corta y moderna.',
    ],
    'Git: ¿cómo deshacer el último commit sin perder los cambios?' => [
        '`git reset --soft HEAD~1` — deshace el commit pero mantiene los cambios en staging listos para volver a commitear.',
        'Si ya hiciste push, necesitas `git revert HEAD` en lugar de reset, para no reescribir el historial remoto.',
    ],
    '¿Cuál es la diferencia entre == y === en JavaScript?' => [
        '`==` compara valores con coerción de tipos: `"5" == 5` es `true`. `===` compara valor Y tipo: `"5" === 5` es `false`. Siempre usa `===` para evitar bugs raros.',
        'Ejemplo clásico: `null == undefined` es `true` con `==`, pero `false` con `===`. Por eso en proyectos serios se usa `===` por defecto.',
    ],
    'TypeError: Cannot read properties of undefined (reading "map")' => [
        'El array llega `undefined` antes de que la API responda. Inicializa el estado con array vacío: `const [data, setData] = useState([])`. Así el `.map()` no explota mientras carga.',
        'También puedes usar optional chaining: `data?.map(...)` o un guard `{data && data.map(...)}` en el JSX.',
    ],
    '¿Qué editor de código recomiendan para empezar a programar?' => [
        'VS Code sin duda. Tiene el ecosistema de extensiones más grande, es gratuito y funciona para cualquier lenguaje. Instala: Prettier, ESLint y GitLens como mínimo.',
        'Si tu compu es lenta, prueba Sublime Text — es más ligero. Pero a largo plazo VS Code vale la pena aprenderlo bien.',
    ],
];

foreach ($answersData as $questionTitle => $answers) {
    $question = Question::where('title', $questionTitle)->first();
    if (!$question) continue;

    foreach ($answers as $content) {
        $question->answers()->create([
            'user_id' => $admin->id,
            'content' => $content,
        ]);
    }
}

    }
}
