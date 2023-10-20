<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ResourceLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        Log::info('Response data is',[
            'method'=>$request->method(),
            'url'=>$request->fullUrl(),
            'ip'=>$request->ip()
        ]

        );

        return $next($request);//pass request further into application
    }
}
