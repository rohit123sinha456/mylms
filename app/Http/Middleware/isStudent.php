<?php

namespace App\Http\Middleware;

use Closure;
Use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class isStudent extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('student')){
        return $next($request);}
        
        return redirect('/student');
        
    }
}
