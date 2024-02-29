<?php

namespace App\Http\Controllers;

use App\Models\IndexUser;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        foreach ($indexUsers as $key => $value) {
            $file = null;

            if ($request->hasFile('notification_image')) {
                $file = $request->file('notification_image');
            }

            $this->sendNotificationIndexUser(1, null, $file, $request->notification_title, $request->notification_text, $request->notification_url, $value->code, $request->notification_date, $request->notification_end_date);
        }

        return redirect()->route('admin_show_notifications')->with('success', 'Başarılı bir şekilde bildirim gönderildi');
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
}
