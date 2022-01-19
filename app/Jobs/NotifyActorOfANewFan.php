<?php

namespace App\Jobs;

use App\Models\Actor;
use App\Models\Fan;
use App\Services\Sms\SmsSender;
use App\Services\Sms\VoodooSmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyActorOfANewFan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Fan $fan)
    {
        $this->fan = $fan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsSender $sender)
    {
        $sender->sendSms($this->fan->actor->mobile, $this->getMessage());
    }

    private function getMessage()
    {
        return "You have are now being followed by " . $this->fan->user->name;
    }
}
