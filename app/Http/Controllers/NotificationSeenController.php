<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        // $this->authorize('update', $notification);
        Gate::authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()
            ->with('success', 'Notification marked as read');
    }
}
