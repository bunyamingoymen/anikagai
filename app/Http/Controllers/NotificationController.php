<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        return view('admin.notification.list');
    }

    public function addNotifications()
    {
        return view('admin.notification.create');
    }
}
