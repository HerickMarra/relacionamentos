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
        "cd {$projectPath} && git pull origin main",
        "cd {$projectPath} && php artisan migrate --force"
    ];

    $output = [];
    foreach ($commands as $command) {
        $output[] = shell_exec($command . " 2>&1");
    }

    return "<pre>" . implode("\n", $output) . "</pre>";
});


