<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\payment;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Notifications\PaymentProofUploaded; 
use App\Models\User;
use App\Notifications\PaymentApproved;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$invoices = invoice::all();
        $payments = payment::all();
        return view('payments.index', ['payments' => payment::paginate(10)], compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('payments.create');
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create1($id)
    {
        $invoices = invoice::find($id);
        return view('payments.create',compact('invoices'));
    }



    public function pending(){
        $payments = payment::all()->where('status',0);
        $payments = $this->paginate($payments);
        $payments->withpath(route('payments.pending'));
        return view('payments.pending_payments',compact('payments', $payments));
    }

    public function approved(){
        $payments = payment::all()->where('status',1);
        $payments = $this->paginate($payments);
        $payments->withpath(route('payments.approved'));
        return view('payments.approved_payments',compact('payments', $payments));
    }

    public function is_approved($id){
        $payments = payment::find($id);
        $payments->status = 1 ;
        $payments->save();
        $user=User::find();
        $admin = Auth()->guard('admin')->user();
        Notification::send($user, new PaymentApproved($admin));
        return redirect()->back()
        ->with('success','The Payment Has Been Approved');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        
        $payments = new payment();
        $invoices = invoice::find($id);
        $payments->invoice = $invoices->invoiceId;
        // $payments->invoice_id = $request->input('invoice_id');
        $payments->amount = $invoices->amount;
        $payments->due_date = $invoices->date;
        $payments->payment_date = $request->input('payment_date');
        if (!empty($request->file)) {
            $file = $request->file;
                $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('payments'), $filename);
                $files = $filename; 
            $payments->proof = $files;
       } 
       $invoices->payment()->save($payments);
       $payments = payment::where('invoice_id',$invoices->id)->latest('created_at')->first();
       $user=Auth()->user();
       $admins = Admin::all();
        Notification::send($admins, new PaymentProofUploaded($user,$invoices,$payments));
    //    Admin::all()->notify(new PaymentProofUploaded($user));
       return redirect()->back()
       ->with('success','The New Payment Is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        return view('payments.show',compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }

    public function download($id){
        $payments = payment::find($id);
        // dd($invoices);
        $fileName = $payments->proof;
        $filePath = public_path('payments/'.$fileName);
      $headers = ['Content-Type: application/pdf'];
     return response()->download($filePath, $fileName, $headers);

    }

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

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    
}
