<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;
use Auth;


class Admin
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

   if (Auth::check()) 
        {

            if (Auth()->user()->role == "1") {
              
                return $next($request);
            }
            else{
                return redirect('/');
            } 
            
        } else{
                return redirect('/');
        }
             

}
}
