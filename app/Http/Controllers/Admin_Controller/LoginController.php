<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin_Panel.registration.login');
    }

    public function authenticateUser(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
        $roleId = $user->role_id;

        if (Auth::attempt($credentials)) {
            if ($roleId  === 1) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('login.index');
            }
        }
        else{
            return back()->withErrors([
            'email' => 'The provided credentials do not match our records!',
            ]);
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
