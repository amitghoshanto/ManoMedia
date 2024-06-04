<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationKey;
use App\Models\NotificationHistory;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PushNotification;
use Google\Cloud\Storage\Notification as StorageNotification;
use Kreait\Firebase\Contract\Messaging;
use NotificationChannels\Fcm\FcmChannel;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class TestController extends Controller
{
    public function index(Messaging $fcm)
    {


        $data = NotificationHistory::where('status', 0)->get();
        foreach ($data as $data) {
            $title = $data->title;
            $body = $data->body . " " . date('Y-m-d H:i:s');
            $key = $data->notification_key;
            $image = $data->image;
            $click_action = $data->short_url;


            $notification = Notification::fromArray([
                'title' => $title,
                'body' => $body,
                'image' => $image,
                "click_action" => $click_action,
                "url" => $click_action,
                "link" => $click_action,
            ]);

            $message = CloudMessage::withTarget('token', $key)
                ->withNotification($notification);

            try {
                $fcm->send($message);
                dump('notification sent');
                //update status if send successfull
                NotificationHistory::where('id', $data->id)->update(['status' => 1]);
            } catch (\Throwable $th) {

                dd($th);
            }
        }
    }
}
