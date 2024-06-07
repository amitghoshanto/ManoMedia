<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\NotificationKey;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationHistory;
use App\Http\Controllers\Controller;
use AshAllenDesign\ShortURL\Classes\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $meta_tag = [
            'title' => 'Admin Dashboard',
            'description' => '',
            'keywords' => '',

        ];

        $count_allowed = NotificationKey::where('type',1)->count();
        $count_decline = NotificationKey::where('type',0)->count();

        return view('admin.dashboard', compact('meta_tag','count_allowed','count_decline'));
    }
    public function send_notification()
    {
    }

    public function category_wise(Request $request, $category)
    {
        // dump($request->all());
        // dump($category);

        $items = NotificationKey::select($category, DB::raw('COUNT(*) as count'))
            ->where('type',1)
            ->groupBy($category)
            ->get();


        $meta_tag = [
            'title' => ucfirst($category) . ' Wise',
            'description' => '',
            'keywords' => '',

        ];

        return view('admin.categorywise', compact('meta_tag', 'category', 'items'));
    }



    public function send_category_wise_store(Request $request, $category)
    {



        $validated = $request->validate([
            'category_data' => 'required',
            'title' => 'required',
            'body' => 'required',
            'full_url' => 'required|url',
        ]);




        $name = $request->category_data;
        $keys = NotificationKey::where($category, $name)->where('type',1)->get();

        foreach ($keys as $key => $value) {
            $secret_key = $value->secret_key;
            $shortURLObject = app(Builder::class)->destinationUrl($request->full_url)->trackVisits()->secure()->make();
            $shortURL = $shortURLObject->default_short_url;
            $notification_history = NotificationHistory::firstOrCreate([
                'notification_key' => $secret_key,
                'title' => $request->title,
                'icon' => $request->icon,
                'image' => $request->image,
                'body' => $request->body,
                'short_url' => $shortURL,
                'full_url' => $request->full_url,
                'click_count' => 0,

            ]);
        }

        return redirect()->back()->with('success', 'Notification stored successfully, Please check notification history for details');
    }




    public function send_to_all(Request $request,)
    {

        $meta_tag = [
            'title' => 'Send To All',
            'description' => '',
            'keywords' => '',

        ];
        $count = NotificationKey::where('type',1)->count();


        return view('admin.storenotification', compact('meta_tag', 'count'));
    }


    public function send_to_all_store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'full_url' => 'required|url',
        ]);

        $keys = NotificationKey::where('type',1)->get();

        foreach ($keys as $key => $value) {
            $secret_key = $value->secret_key;

            $shortURLObject = app(Builder::class)->destinationUrl($request->full_url)->trackVisits()->secure()->make();
            $shortURL = $shortURLObject->default_short_url;
            $notification_history = NotificationHistory::firstOrCreate([
                'title' => $request->title,
                'notification_key' => $secret_key,
                'icon' => $request->icon,
                'image' => $request->image,
                'body' => $request->body,
                'short_url' => $shortURL,
                'full_url' => $request->full_url,
                'click_count' => 0,

            ]);
        }

        return redirect()->back()->with('success', 'Notification stored successfully, Please check notification history for details');
    }


    public function notification_history(Request $request)
    {

        $meta_tag = [
            'title' => 'Notification History',
            'description' => '',
            'keywords' => '',

        ];
        $items = NotificationHistory::orderBy('id', 'desc')->with('shorturl_id')->get();


        return view('admin.notificationhistory', compact('meta_tag', 'items'));
    }
    public function clear_history(Request $request)
    {
        NotificationHistory::truncate();
        return redirect()->back()->with('success', 'Notification history cleared successfully');
    }
}
