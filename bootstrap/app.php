<?php

use App\Http\Middleware\CanViewPassMiddleware;
use App\Http\Middleware\isAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Mail; 
use App\Mail\PostCountMaill;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias(['can-view-post'=> CanViewPassMiddleware::class]);
        $middleware->alias(['is-admin'=>isAdminMiddleware::class]);
    })
    ->withSchedule(function(Schedule $schedule){
        $schedule->call(function(){
            Mail::to('admin@example.com')->send(new PostCountMaill());
        
        })->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
