<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoice::all();
        $payments = payment::all();
        return view('payments.index', ['payments' => payment::paginate(5)], compact('payments','invoices'));
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
        return view('payments.pending_payments',compact('payments'));
    }

    public function approved(){
        $payments = payment::all()->where('status',1);
        return view('payments.approved_payments', ['payments' => payment::paginate(5)],compact('payments'));
    }

    public function is_approved($id){
        $payments = payment::find($id);
        $payments->status = 1 ;
        $payments->save();
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
        $payments->invoice_id = $request->input('invoice_id');
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
       $payments->save();
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
}
