<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::loginView('admin_Panel.registration.login');
        Fortify::registerView('admin_Panel.registration.register');
        Fortify::requestPasswordResetLinkView('admin_Panel.registration.forgot-password');
        Fortify::resetPasswordView('admin_Panel.registration.new-password');
        Fortify::confirmPasswordView('admin_Panel.setting.2faConfirmPassword');
        Fortify::twoFactorChallengeView('admin_Panel.setting.2faChallengeView');

        Fortify::authenticateUsing(function (Request $request) {
            $request->validate(
                [
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                    'g-recaptcha-response' => ['required', 'captcha'],
                ],
                [
                    'email.required' => 'Please enter your email address.',
                    'password.required' => 'Please enter your password.',
                    'g-recaptcha-response.required' => 'Please verify the Captcha.',
                ]
            );

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
            return null;
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
