<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Spatie\Permission\Models\Role;

class NotificationController extends Controller
{

    public function markAllAsRead()
    {
        $users = User::role(['Super Admin', 'Administrator'])->get();
        foreach($users as $user){
            $user->unreadNotifications->markAsRead();
        }
        return response()->json(['success' => true]);
    }

    public function markAsRead($notificationId)
    {
        $users = User::role(['Super Admin', 'Administrator'])->get();

        // $user = User::role('Administrator')->first();
        // $user->notifications()->where('id', $notificationId)->first()->markAsRead();

        foreach ($users as $user) {
            $user->notifications()->where('id', $notificationId)->first()->markAsRead();
        }
        return response()->json(['message' => 'Notification marked as read']);
    }

    public function unreadNotificationsCount()
    {
        $users = User::role(['Super Admin', 'Administrator'])->get();
        foreach ($users as $user) {
            $unreadNotificationsCount = $user->unreadNotifications->count();
        }

        return response()->json([
            'message' => 'Unread notifications count is : ' . $unreadNotificationsCount,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }
}
