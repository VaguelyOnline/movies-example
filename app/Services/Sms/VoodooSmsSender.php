<?php


namespace App\Services\Sms;


use Illuminate\Support\Facades\Log;

class VoodooSmsSender implements SmsSender
{
    public function sendSms(string $mobile, string $message)
    {
        Log::info('Using Voodoo to send SMS');
    }
}
