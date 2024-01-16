<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() === null || $request->user()->employer === null){
            return redirect()->route('employer.create')
                ->with('error' , 'You Need To Register As An Employer First!!');
        }

        return $next($request);
    }
}
