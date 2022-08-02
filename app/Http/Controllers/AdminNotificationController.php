<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminNotificationController extends Controller
{

    public function markasred($id){
        if($id){
            Auth::guard('admin')->user()->notifications->where('id',$id)->markAsRead();
        }
        $msg = Auth::guard('admin')->user()->unreadNotifications->count() ;
        return response()->json(array('msg'=> $msg), 200);
    }

    public function redall(){
        $notifiable_user = Auth::guard('admin')->user();
        $notifiable_user->unreadNotifications->markAsRead();
        return back();
    }

    public function notifications(){
        $user=Auth::guard('admin')->user();
        $notifications = $user->notifications;
        $read_notifications = $user->readNotifications;
        $unread_notifications = $user->unreadNotifications;
        return view('notifications',compact('read_notifications','unread_notifications','notifications'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
