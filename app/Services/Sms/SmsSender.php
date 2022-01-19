<?php


namespace App\Services\Sms;


interface SmsSender
{
    public function sendSms(string $mobile, string $message);
}
