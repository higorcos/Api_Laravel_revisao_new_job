<?php

use App\Exceptions\ProductNotFoundException;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\Teste1Middleware;
use App\Http\Middleware\TesteMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Mockery\Exception\InvalidOrderException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            //TesteMiddleware::class,  #se quiser global 
        ],prepend:[]//final da lista
        );
        //grupo de middleware
         $middleware->appendToGroup('groupMiddlewareTest', [
            TesteMiddleware::class,
            Teste1Middleware::class,
         ]);
        //alies middleware -> nomes 
        $middleware->alias([
            'teste00'=> TesteMiddleware::class,
            'teste01'=> Teste1Middleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //$exceptions->dontReport() // para não colocar o erro de alguma exception no log - usado para erros comnuns
       /*  $exceptions->render(function (InvalidOrderException $e){ // mostrar view diretamente
            return response()->view('errors.invalid-order', [400]);
        }); */

        //modelo para API
       /*   $exceptions->render(function (ProductNotFoundException $e){ // mostrar view diretamente
            return response()->json([
                'error'=> 'ProductNotFoundException',
            ],400);
        }); */

       /*  $exceptions->report(function(InvalidOrderException $e){
            //dd($e);
        }); */
        
    })->create();
