<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Setting;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

use Illuminate\Http\Request;
use App\Models\NotificationKey;
use App\Models\NotificationHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;


class HomeController extends Controller
{

    public function index()
    {

        $meta_tag = [
            'title' => 'Home Page',
            'description' => 'Home Page',
            'keywords' => 'Home Page',
        ];
        return view('download', compact('meta_tag'));
    }

    public function notifymessage()
    {

        $meta_tag = [
            'title' => 'Allow Notification',
            'description' => 'Allow Notification',
            'keywords' => 'Allow Notification',
        ];
        return view('welcome', compact('meta_tag'));
    }
    public function gitPull()
    {

        $process = new Process(['git', 'pull']);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if ($process->isSuccessful()) {
            return '<code>' . 'Git pull successful: ' . $process->getOutput() . '</code>';
        }

        return '<code>' . 'Git pull failed: ' . $process->getErrorOutput() . '</code>';
    }

    // public function test(Request $request)
    // {
    //     dump($request->ip());
    //     $ip = '118.179.44.68';

    //     $client = new Client();
    //     $apiinfo = $client->request('GET', 'http://ip-api.com/php/' . $ip);
    //     $apiinfo = unserialize($apiinfo->getBody()->getContents());
    //     $country = $apiinfo['country'] ?? 'Null';
    //     $timezone = $apiinfo['timezone'] ?? 'Null';
    //     $agent = new Agent();
    //     $device = $agent->device();
    //     $platform = $agent->platform();
    //     $browser = $agent->browser();
    //     $language = $agent->languages()[0];
    // }
    public function firebase_store_key(Request $request)
    {
        $notifyToken = $request->token;
        $ip = $request->ip();
        $client = new Client();
        $apiinfo = $client->request('GET', 'http://ip-api.com/php/' . $ip);
        $apiinfo = unserialize($apiinfo->getBody()->getContents());
        if ($apiinfo) {
            $country = $apiinfo['country'] ?? 'Null';
            $timezone = $apiinfo['timezone'] ?? 'Null';
        } else {
            $country = Null;
            $timezone = Null;
        }
        $country = $apiinfo['country'] ?? Null;
        $timezone = $apiinfo['timezone'] ?? Null;
        $agent = new Agent();
        $device = $agent->device() ?? Null;
        $platform = $agent->platform() ?? Null;
        $browser = $agent->browser() ?? Null;
        $language = $agent->languages()[0] ?? Null;

        //slug create


        // Find or create the record
        $notify_key = NotificationKey::firstOrCreate(['secret_key' => $notifyToken], [
            'type' => 1,
            'country' => Str::slug($country),
            'timezone' => Str::slug($timezone),
            'device' => Str::slug($device),
            'platform' => Str::slug($platform),
            'browser' => Str::slug($browser),
            'language' => Str::slug($language),
            'ip' => $ip,
            'missed' => 0,
        ]);

        // Update time if the record already existed
        if ($notify_key->wasRecentlyCreated) {
            $response = ['message' => 'new-stored'];
            Setting::where('id', 1)->increment('fcm_allowed');
        } else {
            $notify_key->update(['updated_at' => time()]);
            $response = ['message' => 'time-update'];
        }

        return response()->json($response);
    }

    public function firebase_decline_key(Request $request)
    {


        $notifyToken = $request->token;
        $ip = $request->ip();
        $client = new Client();
        $apiinfo = $client->request('GET', 'http://ip-api.com/php/' . $ip);
        $apiinfo = unserialize($apiinfo->getBody()->getContents());
        if ($apiinfo) {
            $country = $apiinfo['country'] ?? Null;
            $timezone = $apiinfo['timezone'] ?? Null;
        } else {
            $country = Null;
            $timezone = Null;
        }
        $agent = new Agent();
        $device = $agent->device() ?? Null;
        $platform = $agent->platform() ?? Null;
        $browser = $agent->browser() ?? Null;
        $language = $agent->languages()[0] ?? Null;

        //slug create


        // Find or create the record
        $notify_key = NotificationKey::firstOrCreate(
            [
                'type' => 0,
                'secret_key' => NULL,
                'country' => Str::slug($country),
                'timezone' => Str::slug($timezone),
                'device' => Str::slug($device),
                'platform' => Str::slug($platform),
                'browser' => Str::slug($browser),
                'language' => Str::slug($language),
                'ip' => $ip,
                'missed' => 0,
            ],

            [
                'type' => 0,
                'secret_key' => NULL,
                'country' => Str::slug($country),
                'timezone' => Str::slug($timezone),
                'device' => Str::slug($device),
                'platform' => Str::slug($platform),
                'browser' => Str::slug($browser),
                'language' => Str::slug($language),
                'ip' => $ip,
                'missed' => 0,
            ]
        );

        // Update time if the record already existed
        if ($notify_key->wasRecentlyCreated) {
            $response = ['message' => 'new-decline-store'];
            Setting::where('id', 1)->increment('fcm_decline');
        } else {
            $notify_key->update(['updated_at' => time()]);
            $response = ['message' => 'decline-time-update'];
        }

        return response()->json($response);
    }
    public function offLine()
    {
        echo 'No Internet Connection';
    }






    public function sendNotification(Messaging $fcm)
    {


        $data = NotificationHistory::where('status', 0)->where('notification_key', '!=', NULL)->get();
        if (count($data) > 0) {
            foreach ($data as $data) {
                $title = $data->title;
                $body = $data->body;
                $token = $data->notification_key;
                $image = $data->image;
                $click_action = $data->short_url;

                $webPushConfig = WebPushConfig::fromArray([
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                        'icon' => $image,
                    ],
                    'fcm_options' => [
                        'link' => $click_action,
                    ],
                ]);

                $message = CloudMessage::withTarget('token', $token)
                    ->withWebPushConfig($webPushConfig);

                try {
                    $fcm->send($message);
                    echo 'notification sent';
                    //update status if send successfull
                    NotificationHistory::where('id', $data->id)->update(['status' => 1]);
                } catch (\Throwable $th) {

                    echo 'error sending notification check bug';
                    NotificationHistory::where('id', $data->id)->update(['status' => 2]);
                    dump($th);
                }






                // $notification = Notification::fromArray([
                //     'title' => $title,
                //     'body' => $body,
                //     'image' => $image,
                //     "click_action" => $click_action,
                //     "url" => $click_action,
                //     "link" => $click_action,
                // ]);

                // $message = CloudMessage::withTarget('token', $key)
                //     ->withNotification($notification);

                // try {
                //     $fcm->send($message);
                //     echo 'notification sent';
                //     //update status if send successfull
                //     NotificationHistory::where('id', $data->id)->update(['status' => 1]);
                // } catch (\Throwable $th) {

                //     echo 'error sending notification check bug';
                //     NotificationHistory::where('id', $data->id)->update(['status' => 2]);
                //     // dump($th);
                // }
            }
        } else {
            echo 'no pending notification found';
        }
    }
}
