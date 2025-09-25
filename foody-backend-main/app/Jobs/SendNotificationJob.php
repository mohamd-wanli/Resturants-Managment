<?php

namespace App\Jobs;

use App\Services\Notifications\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $firebaseService;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $users)
    {
        $this->firebaseService = new NotificationService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $type = 'notification';
        $title = 'You Have New Order';
        $body = 'You Have New Order';
        $content = 'You Have New Order';
        foreach ($this->users as $user) {
            $this->firebaseService->sendNotification($user->deviceKey, $title, $body);
        }
    }
}
