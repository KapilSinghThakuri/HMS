<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class GenerateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates A Super User With All The Permissions';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $truncate = $this->confirm("Do you want to remove all the users", false);
        if ($truncate) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        $name = $this->ask("What is your name ?");
        $email = $this->ask("What is your email");
        $password = $this->secret("What is the password");
        $confirm_password = $this->secret("Please confirm the password");

        if ($password === $confirm_password) {
            $user = User::create([
                'username' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'address' => 'Healwave - Medical',
                'phone' => 9706934334,
            ]);
            $role = Role::findByName("Administrator");
            $user->assignRole($role);
            $this->info("Created Super User $email");
        } else {
            $this->error("Password and Password Confirmation Did not Match");
        }
    }
}
