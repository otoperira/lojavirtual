<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Este bloco força o redirecionamento do "Dashboard" padrão para os seus Produtos
            Route::middleware(['web', 'auth'])
                ->get('/dashboard', function () {
                    return redirect()->route('products.index'); 
                });
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Redireciona usuários não autenticados (convidados) para a home em vez de erro
        $middleware->redirectGuestsTo(fn () => route('login'));
        
        // Redireciona usuários logados que tentam acessar login/register para os produtos
        $middleware->redirectTo(fn () => route('products.index'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();