<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {   

         if ($request->user()->roles[0]->title != $role) {

            if($request->user()->roles[0]->title =='Admin' || $request->user()->roles[0]->title =='Executive')
            {
               
            }
            else
            {
                 return redirect('/nopermission');
            }
        }

        return $next($request);
    }
}
