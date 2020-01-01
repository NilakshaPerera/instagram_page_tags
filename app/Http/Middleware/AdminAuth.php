<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminAuth
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
       
       if (!Auth::guard()->check()) {
           if ($request->ajax()) {
               return response('Unauthorized.', 401);
           }else{
               return redirect('/login');
           }
       }
       
       $response = $next($request);
       $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0')->header('Pragma', 'no-cache')->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');

       return $response;
   }
}