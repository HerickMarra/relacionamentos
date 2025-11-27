<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::match(['get', 'post'], '/deploy', function () {
    // ⚠️ Proteção simples com token na URL
    // $token = request()->query('token');
    // if ($token !== env('DEPLOY_TOKEN')) {
    //     abort(403, 'Unauthorized');
    // }

    // Caminho do seu projeto
    $projectPath = base_path();

    // Comandos a executar
    $commands = [
    // Ir para o projeto e atualizar o código
    "cd {$projectPath} && git pull origin main",

    // Instalar dependências do Composer sem dev
    // "cd {$projectPath} && composer install --no-interaction --prefer-dist --optimize-autoloader",

    // Limpar caches antes da migração (evita erros)
    "cd {$projectPath} && php artisan cache:clear",
    "cd {$projectPath} && php artisan config:clear",
    "cd {$projectPath} && php artisan view:clear",
    "cd {$projectPath} && php artisan route:clear",

    // Rodar as migrações
    "cd {$projectPath} && php artisan migrate --force",

    // Regerar caches otimizados
    "cd {$projectPath} && php artisan config:cache",
    "cd {$projectPath} && php artisan route:cache",
    "cd {$projectPath} && php artisan view:cache",
    "cd {$projectPath} && php artisan event:cache",

    // Otimização geral do framework
    "cd {$projectPath} && php artisan optimize",

    ];

    $output = [];
    foreach ($commands as $command) {
        $output[] = shell_exec($command . " 2>&1");
    }

    return "<pre>" . implode("\n", $output) . "</pre>";
});


