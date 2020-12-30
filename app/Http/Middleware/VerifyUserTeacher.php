<?php

namespace App\Http\Middleware;

// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyUserTeacher 
{
    /**
     * The URIs that should be excluded from User verification.
     *
     * 
     */

    public function handle($request, Closure $next)
    {

        if($request->session()->get('type') == 'Teacher'){
            return $next($request); 
        }
        else{
            $request->session()->flash('msg', 'Invalid Resource Request, You are not allowed to view this resource.');
            return redirect()->route('user.login');
        }
    }
    
}
