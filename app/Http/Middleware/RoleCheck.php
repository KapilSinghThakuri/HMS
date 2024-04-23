<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $users = Auth::user();
        $user_role_id = $users->role_id;
        if ($user_role_id === 1) {
            return $next($request);
        }elseif($user_role_id === 2) {
                return redirect()->route('doctor.dashboard');
            }else{
            return back();
        }
    }
}
