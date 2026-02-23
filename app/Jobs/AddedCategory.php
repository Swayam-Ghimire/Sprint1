<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\User;
use App\Notifications\CategoryAddedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class AddedCategory implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $users;

    protected $category;

    /**
     * Create a new job instance.
     */
    public function __construct(Category $category)
    {
        $this->users = User::all();
        $this->category = $category->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->users, new CategoryAddedNotification($this->category));
    }
}
