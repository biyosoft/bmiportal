<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\UploadFile;
use App\Models\User;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class fileController extends Controller
{
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

    public function bulkUpload(Request $request){
        $size = count($request->file);
        for($i=0 ; $i<$size ; $i++)
        {
            $invoices = new invoice();
            $invoices->user_id = $request->input('user_id')[$i];
            $invoices->date = $request->input('date')[$i];
            // if (!empty($request->file[$i])) {
            //         $file = $request->file[$i];
            //     $filename = time().'-'.$file->getClientOriginalName();  
            //     $file->move(public_path('documents'), $filename);
            //     $files = $filename; 
            // }
            $invoices->invoice_doc = $request->file[$i];
            $invoices->amount = $request->input('amount')[$i];
            $invoices->invoiceId = $request->input('invoiceId')[$i];
            $invoices->customer_no = $request->input('customer_no')[$i];
            $invoices->save();
        }
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Updated Succesfully !');
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
            'file' => 'required',
        ]);
        $users = User::all();
        $file = $request->file;
        $files = count($request->file);
        $amount = array();
        $invoice_no = array();
        $customer_no = array();
        $invoice_date = array();
        $payment_term = array();

        foreach($request->file as $file)
        {
            $prev_files[] = 'INV'.'-'.time().'-'.$file->getClientOriginalName();
            $name=time().'-'.$file->getClientOriginalName();  
            $data[] = $name;  
            $filename = time().'-'.$file->getClientOriginalName();  
            // $file->move(public_path('invoices'), $filename);
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
            $skuList = preg_split('/\r\n|\r|\n/', $content);
            
            foreach ($skuList as $value) {
                if (strpos($value, 'Total Amount Malaysian Ringgit') !== false) 
                    { 
                        $amount1 = trim($value , "Total Amount Malaysian Ringgit");
                        $amount[]= $amount1;
                    }
                else if (strpos($value, 'Invoice No.:') !== false) 
                    { 
                        $invoice_no1 = trim($value , "Invoice No.:");
                        $invoice_no[]= $invoice_no1;
                    }
                else if (strpos($value, 'Customer No.:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Customer No.:");
                        $customer_no[]= $customer_no1;
                    }
                else if (strpos($value, 'Invoice Date:') !== false) 
                    { 
                        $invoice_date1 = trim($value , "Invoice Date:");
                        $invoice_date[]=$invoice_date1;
                    }
                else if (strpos($value, 'Payment Terms:') !== false) 
                    { 
                        $payment_term1 = trim($value , "Payment Terms: Days fr Invoice Date (EOM)");
                        $payment_term[]=$payment_term1;
                    }
                }
            }
        return view('invoices.bulk-invoice',compact('users','files','data','amount','invoice_no','customer_no','prev_files','invoice_date'));

    }
    public function bulkInvoices(){
        return view('invoices.bulk-invoice');
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
