<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\PasswordResetNotification;
use App\Http\Requests\LoginCredentialRequest;



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
        $remember = $request->filled('remember');

        if ($user = User::where('email', $request->email)->first()) {
            $roleId = $user->role_id;
        }else{
            return back()->withErrors([
            'email' => 'The provided credentials do not match our records!',]);
        }

        if (Auth::attempt($credentials, $remember)) {
            if ($roleId  === 1) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }elseif ($roleId === 2) {
                return redirect()->route('doctor.dashboard');
            }else{
                return redirect()->route('general.dashboard');
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
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('admin_Panel.registration.forgot-password');
    }
    function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $email = $request->input('email');
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $user = User::where('email',$email)->firstOrFail();
        if ($user) {
            $user->notify(new PasswordResetNotification($token));
        }

        return back()->with('success','We have send an email to reset password.');
    }

    public function resetPassword($token)
    {
        return view('admin_Panel.registration.new-password',compact('token'));
    }
    public function resetPasswordPost(LoginCredentialRequest $request)
    {
        $validatedData = $request->validated();

        $checkEmailToken = DB::table('password_resets')
            ->where([
                'email' => $validatedData['email'],
                'token' => $validatedData['token']
            ])->first();

        if (!$checkEmailToken) {
            return back()->with('error','Your email is invalid!!');
        }

        $user = User::where('email', $validatedData['email'])->first();
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        DB::table('password_resets')->where('email', $validatedData['email'])->delete();

        return redirect()->route('login.index')->with('success','Your password has been reset Successfully!!');
    }
}
