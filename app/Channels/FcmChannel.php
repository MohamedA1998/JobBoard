<?php

namespace App\Channels;

use Google\Client as GoogleClient;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmChannel
{
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toFcm($notifiable);

        $this->SendMessage($message);
    }

    private function SendMessage(array $message)
    {
        $token = $this->GetAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token['access_token'],
            'Content-Type' => 'application/json',
        ])->post(config('fcm.send_message_url'), $message);

        if ($response->failed()) {
            Log::error('Status: ' . $response->status() . ' & Body:' . $response->body());
        }
    }

    private function GetAccessToken()
    {
        $client = new GoogleClient();
        $client->setAuthConfig(config('fcm.private_key_file'));
        $client->addScope(config('fcm.auth_scope'));
        $client->refreshTokenWithAssertion();
        return $client->getAccessToken();
    }
}
