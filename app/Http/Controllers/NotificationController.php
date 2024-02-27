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
            $notification = new NotificationUser();
            $notification->code = NotificationUser::max('code') + 1;

            if ($request->hasFile('notification_image')) {
                $file = $request->file('notification_image');
                $path = "files/notifications/" . $notification->code;
                $public_path = public_path($path);
                $name = $notification->code . "_notification" . $file->getClientOriginalExtension();
                $file->move($public_path, $name);
                $notification->notification_image = $path . "/" . $name;
            }

            $notification->notification_title = $request->notification_title;
            $notification->notification_text = $request->notification_text;
            $notification->notification_url = $request->notification_url;

            $notification->from_user_code = Auth::guard('admin')->user()->code;
            $notification->to_user_code = $value->code; //tüm kullanıcılar

            $notification->notification_date = $request->notification_date;
            $notification->notification_end_date = $request->notification_end_date;

            $notification->create_user_code = Auth::guard('admin')->user()->code;

            $notification->save();
        }

        return redirect()->route('admin_show_notifications')->with('success', 'Başarılı bir şekilde bildirim gönderildi');
    }
}
