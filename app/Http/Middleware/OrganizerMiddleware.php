<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class OrganizerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $roleId = auth()->user()->role_id;

        $role = Role::where('id', $roleId)->value('name');
        
        if ($role === 'organizer' || $role === 'admin') {
            return $next($request);
        } else {  
            return response()->json(['message' => 'unauthorized']);
        }
    }
}
