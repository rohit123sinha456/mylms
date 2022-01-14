<?php

namespace App\Http\Middleware;

use Closure;
Use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class isAdmin extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('admin')){
        return $next($request);}
        
        return redirect('/');
        
    }
}
