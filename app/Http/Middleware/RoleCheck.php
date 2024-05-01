<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
        if ($users) {
            if ($users->hasRole(['Super Admin', 'Administrator'])) {
                return $next($request);
            }elseif($users->hasRole('Doctor')) {
                return redirect()->route('doctor.dashboard');
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
