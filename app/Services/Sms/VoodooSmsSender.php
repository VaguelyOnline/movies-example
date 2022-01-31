<?php


namespace App\Services\Sms;


use Illuminate\Support\Facades\Log;

class VoodooSmsSender implements SmsSender
{
    public function sendSms(string $mobile, string $message)
    {
        // set the API key
        $apiKey = config('services.sms.api_key_voodoo');

        Log::info('Using Voodoo to send SMS');
    }
}
