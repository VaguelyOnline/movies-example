<?php


namespace App\Services\Sms;


class LoadBalancedFallbackSmsSender implements SmsSender
{

    public function sendSms(string $mobile, string $message)
    {
        $services = $this->getShuffledServices();
        foreach($services as $service)
        {
            if ($this->attemptToSendSmsThrough($service, $mobile, $message))
            {
                break;
            }
        }
    }

    private function getShuffledServices()
    {
        $services = [];
        $services[] = app(VoodooSmsSender::class);
        $services[] = app(SmsGlobalSender::class);

        shuffle($services);
        return $services;
    }

    /**
     * @param $service
     * @param string $mobile
     * @param string $message
     * @return boolean true if the message was successfully send through the service
     */
    private function attemptToSendSmsThrough(SmsSender $service, string $mobile, string $message): bool
    {
        return $service->sendSms($mobile, $message);
    }
}
