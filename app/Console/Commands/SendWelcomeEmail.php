<?php

namespace App\Console\Commands;

use App\Jobs\SendWelcomeEmail as SendWelcomeEmailJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SendWelcomeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-welcome-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send welcome email when a user is registered';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testUser = new User;

        $testUser->name = fake()->name();
        $testUser->email = fake()->unique()->safeEmail();
        $testUser->email_verified_at = now();
        $testUser->password = Hash::make('password');
        $testUser->remember_token = Str::random(10);

        $testUser->save();

        SendWelcomeEmailJob::dispatch($testUser);
    }
}
