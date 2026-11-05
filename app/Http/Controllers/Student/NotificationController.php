<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        /** @var User $student */
        $student = Auth::user();

        $notifications = $student->notifications()
            ->latest()
            ->paginate(10);

        $unreadCount = $student->unreadNotifications()
            ->count();

        return view('student.notifications.index', compact(
            'notifications',
            'unreadCount'
        ));
    }

    public function markAsRead(string $id)
    {
        /** @var User $student */
        $student = Auth::user();

        $notification = $student->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return back()->with(
            'success',
            'Notification marked as read.'
        );
    }
}
