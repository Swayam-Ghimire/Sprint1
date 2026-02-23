<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class LogUserRegistered implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new UserRegisteredNotification($this->user));
    }
}
