<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class customerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select("*")
        ->where("form_status",2)->paginate(10);
        return view('customers.index', compact('users'));
    }

    public function list()
    {
        $users = User::select("*")
        ->where("form_status",1)->paginate(10);
        return view('customers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            
        ]);
           
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->company = $request->input('company');
        $users->phone = $request->input('phone');
        $users->status = $request->input('status');
        $users->password = Hash::make($request->password);
        $users->save();
        return back()->with('success' , 'Customer Has Been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view('customers.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('customers.edit',compact('users'));
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
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->customer_no = $request->input('customer_no');
        $users->email = $request->input('email');
        $users->company = $request->input('company');
        $users->payment_term = $request->input('payment_term');
        $users->phone = $request->input('phone');
        $users->status = $request->input('status');
        $users->save();
        return back()->with('success' , 'Customer Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $users = User::find($id);
        $name = $users->name;
        $users->delete();
        return back()->with('error','The User '. $name .' Is Deleted');
    }

    public function profile(){
        $customerId = Auth::user()->id;
        $users = User::find($customerId);
        return view('profile',compact('users'));
    }

    public function change_password(Request $request)
    {
        $customerId = Auth::user()->id;
        $users = User::find($customerId);
        return view('change_password',compact('users'));
    }

    public function change_password_api(Request $request)
    {
        $customerId = Auth::user()->id;
        $user = User::find($customerId);
        $existing_pass = $request->existing_pass;
        $new_pass = $request->new_pass;
        $reapeat_new_pass = $request->repeat_new_pass;
        // echo $new_pass.' = '.$reapeat_new_pass;die;
        if ($new_pass != $reapeat_new_pass) {
            return back()->with('error','New pass and repeat new pass does not match');
        }else{
            if(Hash::check($existing_pass, $user->password)){
                // return "User found";
                $user->password = Hash::make($request->new_pass);
                $user->save();
                return back()->with('success','Successfullt Password Changed');
            }else{
                return back()->with('error','Please input correct old password');
            }
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store1(Request $request,$id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', ],
            'phone' => ['required'],
            'address' => ['required'],
            'file1' => ['required'],
            'file2' => ['required'],
        ]);

        $users = User::find($id);
        if(!empty($request->file1)){
            $file1 = $request->file1;
            $filename1 = time()."-".$file1->getClientOriginalName();
            $file1->move(public_path('documents'), $filename1);
            $files1 = $filename1;
            $users->file1 = $files1;
            //echo $files;die;
        }
        if(!empty($request->file2)){
            $file2 = $request->file2;
            $filename2 = time()."-".$file2->getClientOriginalName();
            $file2->move(public_path('documents'), $filename2);
            $files2 = $filename2;
            $users->file2 = $files2;
            //echo $files;die;
        }

        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->company = $request->input('company');
        $users->phone = $request->input('phone');
        $users->address = $request->input('address');
        $users->form_status = 1 ;
        $users->save();
        return back()->with('success' , 'Form Is Submitted For Approval');
    }

    public function formStatus($id){

        $users = User::find($id);
        $name = $users->name;
        $users->form_status = 2 ;
        $users->save();
        return redirect()->route('customers.index')->with('success','The User '. $name .' Is Approved');
    }
}
