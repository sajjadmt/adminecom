<?php

namespace App\Http\Controllers\User;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function AllNotification(User $user)
    {
        $notifications = $user->notifications->toArray();
        return $notifications;
    }

    public function Notifications()
    {
        $notifications = Notification::with('user')->orderBy('id', 'desc')->get();
        return view('admin.notification.all-notification', compact('notifications'));
    }

    public function NotificationToggleStatus(Request $request)
    {
        $notification = Notification::findOrFail($request->id);
        $notification->status = $notification->status === 'read' ? 'unread' : 'read';
        $notification->save();
        return response()->json(['status' => $notification->status]);
    }

    public function NotificationSearch(Request $request)
    {
        $query = $request->input('query');
        $notifications = Notification::where('title', 'LIKE', "%{$query}%")
            ->orWhere('message', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();
        return view('admin.notification.notification-table-body', compact('notifications'));
    }

    public function EditNotification($id)
    {
        $notification = Notification::where('id',$id)->with('user')->first();
        return view('admin.notification.edit-notification',compact('notification'));
    }

    public function ShowNotification($id)
    {
        $notification = Notification::where('id',$id)->with('user')->first();
        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function DeleteNotification($id)
    {
        $item = Notification::findOrFail($id);
        if ($item->status === 'unread'){
            $notification = array(
                'message' => 'Read Notification And Then Delete It.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $item->delete();
        $notification = array(
            'message' => 'Notification Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

}
