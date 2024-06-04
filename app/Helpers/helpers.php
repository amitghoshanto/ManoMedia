<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

function sendNotification($source, $token, $body, $title, $image, $click_action)
{
    $icon = 'https://cdn.thetolet.com/images/thetolet-logo.png';
    $url = "https://fcm.googleapis.com/fcm/send";

    $headers = [
        'Authorization' => 'key=AIzaSyB8oKrNYUg5FE5bBpH1W-M9OkKC8Snk2UE',
        'Content-Type' => 'application/json',
    ];

    if ($source == 1) {
        // Web Notification
        $data = [
            "to" => $token,
            "notification" => [
                "body" => $body,
                "title" => $title,
                "icon" => $icon,
                "image" => $image,
                "click_action" => $click_action,
            ],
        ];
    } else {
        // Android Notification
        $data = [
            "to" => $token,
            "data" => [
                "body" => $body,
                "title" => $title,
                "icon" => $icon,
                "image" => $image,
                "click_action" => $click_action,
                "url" => $click_action,
            ],
        ];
    }

    $response = Http::withHeaders($headers)->post($url, $data);

    return $response->json(); // You can change this depending on how you want to handle the response.
}
