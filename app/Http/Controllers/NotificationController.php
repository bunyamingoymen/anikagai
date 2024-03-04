<?php

namespace App\Http\Controllers;

use App\Models\IndexUser;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        return view('admin.notification.list');
    }

    public function addNotificationsScreen()
    {
        return view('admin.notification.create');
    }

    public function addNotifications(Request $request)
    {
        $indexUsers = IndexUser::where('deleted', 0)->get();
        $image_url = "index/img/default/notification.jpg";
        if ($request->hasFile('notification_image')) {

            $randomString = Str::random(5);
            $file = $request->file('notification_image');
            $path = "files/notifications/" . $randomString;
            $public_path = public_path($path);
            $name = $randomString . "_notification." . $file->getClientOriginalExtension();

            $file->move($public_path, $name);

            $image_url = $path . "/" . $name;
        }
        $notification_code = NotificationUser::max('notification_code') + 1;
        $this->sendNotificationIndexUser($image_url, $request->notification_title, $request->notification_text, $request->notification_url, 0, $request->notification_date, $request->notification_end_date, $notification_code);
        foreach ($indexUsers as $key => $value) {
            $this->sendNotificationIndexUser($image_url, $request->notification_title, $request->notification_text, $request->notification_url, $value->code, $request->notification_date, $request->notification_end_date, $notification_code);
        }

        return redirect()->route('admin_show_notifications')->with('success', 'Başarılı bir şekilde bildirim gönderildi');
    }

    public function deleteNotification()
    {
        dd('deleteNotification');
    }

    public function readNotification(Request $request)
    {
        $user = IndexUser::Where('code', Auth::user()->code)->first();
        if (!$user) return ['result' => 0];


        $notification = NotificationUser::Where('code', $request->code)->where('to_user_code', $user->code)->first();

        if (!$notification) return ['result' => 1];

        $notification->readed = 1;
        $notification->save();

        return ['result' => 2];
    }

    public function allReadNotification()
    {
        $user = IndexUser::where('code', Auth::user()->code)->first();

        NotificationUser::Where('to_user_code', $user->code)->update(['readed' => 1]);

        return true;
    }

    public function notificationGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $notifications = NotificationUser::Where('deleted', 0)->where('to_user_code', 0)->orderBy('created_at', 'DESC')->skip($skip)->take($take)->get();
        $page_count = ceil(NotificationUser::Where('deleted', 0)->where('to_user_code', 0)->count() / $take);
        return ['notifications' => $notifications, "page_count" => $page_count];;
    }
}
