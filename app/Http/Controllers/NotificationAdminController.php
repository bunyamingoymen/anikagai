<?php

namespace App\Http\Controllers;

use App\Models\NotificationAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class NotificationAdminController extends Controller
{
    public function sendMessage(Request $request)
    {
        $newMessage = new NotificationAdmin();

        $newMessage_code = NotificationAdmin::orderBy('created_at', 'DESC')->first();
        if ($newMessage_code) $newMessage->code = $newMessage_code->code + 1;
        else $newMessage->code = 1;

        $newMessage->notification_title = $request->notification_title;
        $newMessage->notification_text = $request->notification_text;
        $newMessage->from_user_code = Auth::user()->code;
        $newMessage->to_user_code = $request->to_user_code;
        $newMessage->readed = 0;

        $newMessage->save();

        if ($request->answer != 0) {
            $noti = NotificationAdmin::Where('code', $request->answer)->first();
            if ($noti) {
                $noti->readed = 1;
                $noti->save();
            }
        }

        return redirect()->back()->with('success', Config::get('success.success_codes.10130012'));
    }

    public function readNotification(Request $request)
    {
        $noti = NotificationAdmin::Where('code', $request->code)->first();

        if ($noti->to_user_code != Auth::user()->code) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0130012'));
        }

        $noti->readed = 1;
        $noti->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10130112'));
    }
}
