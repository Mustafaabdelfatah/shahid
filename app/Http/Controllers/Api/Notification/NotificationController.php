<?php

namespace App\Http\Controllers\Api\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = $user->notifications()->get();

        return response()->json([
            'message' => 'success',
            'status' => JsonResponse::HTTP_OK,
            'data' => NotificationResource::collection($notifications),
        ]);
    }
    public function unreadNotificationsCount(Request $request)
    {
        $user = $request->user();
        $unreadCount = $user->unreadNotifications()->count();
        return response()->json([
            'message' => 'success',
            'status' => JsonResponse::HTTP_OK,
            'unread_count' => $unreadCount,
        ]);
    }


    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();

        return response()->json([
            'message' => 'All notifications marked as read',
            'status' => JsonResponse::HTTP_OK,
        ]);
    }
}
