<?php namespace App\Http\Controllers;
use Auth;

class NotificationsController extends Controller
{

    /**
     * Display a listing of notifications
     *
     * @return Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications();

        Auth::user()->notification_count = 0;
        Auth::user()->save();

        return view('notifications.index', compact('notifications'));
    }

    public function count()
    {
        return Auth::user()->notification_count;
    }
}
