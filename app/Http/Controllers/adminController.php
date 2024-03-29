<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index',['admins' => Admin::paginate(10)],compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
           
        $users = new Admin();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->password);
        $users->save();
        return back()->with('success' , 'Admin Has Been Added Successfully');
    }

    public function store1(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', ],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        $customerId = Auth::guard('admin')->user()->id;
        $admin = Admin::find($customerId);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->address = $request->input('address');
        $admin->save();
        return back()->with('success' , 'Successfully Updated!');
    }

    public function change_password_admin(Request $request)
    {
        $customerId = Auth::guard('admin')->user()->id;
        $users = Admin::find($customerId);
        return view('admins/change_password',compact('users'));
    }

    public function change_password_api_admin(Request $request)
    {
        $customerId = Auth::guard('admin')->user()->id;
        $user = Admin::find($customerId);
        $existing_pass = $request->existing_pass;
        $new_pass = $request->new_pass;
        $reapeat_new_pass = $request->repeat_new_pass;
        // echo $new_pass.' = '.$reapeat_new_pass;die;
        // print_r($user->password);
        // echo $existing_pass;die;
        if ($new_pass != $reapeat_new_pass) {
            return back()->with('error','New pass and repeat new pass does not match');
        }else{
            if(Hash::check($existing_pass, $user->password)){
                // return "User found";
                $user->password = Hash::make($request->new_pass);
                $user->save();
                return back()->with('success','Successfullt Password Changed');
            }else{
                // return "User Not Found";
                return back()->with('error','Please input correct old password');
            }
        }
    }

    public function profile_admin()
    {
        $customerId = Auth::guard('admin')->user()->id;
        $users = Admin::find($customerId);
        return view('admins/profile',compact('users'));
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
