<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        $admin = User::where('role_id', 1)->first();
        $admin->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAsRead($notificationId)
    {
        $admin = User::where('role_id', 1)->first();
        $admin->notifications()->where('id', $notificationId)->first()->markAsRead();
        return response()->json(['message' => 'Notification marked as read']);
    }

    public function unreadNotificationsCount()
    {
        $admin = User::where('role_id', 1)->first();
        $unreadNotificationsCount = $admin->unreadNotifications->count();

        return response()->json([
            'message' => 'Unread notifications count is : ' . $unreadNotificationsCount,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }
}
