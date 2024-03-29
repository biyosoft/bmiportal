<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\User;
use App\Notifications\NewInvoiceAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use App\Exports\InvoiceExport;
use App\Exports\User_invoiceExport;
use Excel;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Input\Input;

use function GuzzleHttp\Promise\all;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $invoiceId = $request->input('invoiceId');
        $date = $request->input('date');

        if (!empty($date)) {
            $date = date('Y-m-d', strtotime($date));
            
        }else{
            $date = "";
        }

        if($request){
            if(!empty($user_id) || !empty($invoiceId) || !empty($date)){
                $invoices = invoice::where('user_id', 'like', '%'.$user_id.'%')
                ->where('invoiceId', 'like', '%'.$invoiceId.'%')
                ->where('date', 'like', '%'.$date.'%')->paginate(4)
                ->appends(['user_id'=> $user_id, 'invoiceId' => $invoiceId, 'date' => $date]);
            }
            else {
                $invoices = invoice::paginate(25);
            }
            
        }
        elseif($request==1){
            return Excel::download(new InvoiceExport($user_id,$invoiceId,$date),'invoicelist.xlsx');
        }
        

        return view('invoices.index', compact('invoices'));
    }   
    

    public function user_invoices()
    {
        $user = Auth::user();
        $user_id = $user->id;
        return view('invoices.user_invoices', ['invoices' => invoice::where('user_id', $user_id)->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('invoices.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $invoices = new invoice();
        $invoices->user_id = $request->input('user_id');
        $invoices->invoiceId = $request->input('invoiceId');
        $invoices->date = $request->input('date');
        $invoices->invoice_date = $request->input('invoice_date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = 'INV'.'-'.$file->getClientOriginalName();  
                $file->move(public_path('documents'), $filename);
                $files = $filename; 
                $invoices->invoice_doc = $files;
        }
        $invoices->amount = $request->input('amount');
        $invoices->save();
        $id = $request->input('user_id');
        $user = User::find($id);
        $admin_user = Auth::guard('admin')->user();
        $invoices = invoice::latest('created_at')->first();
        // Notification::send($user, new NewInvoiceAdded($admin_user,$invoices));
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Added Succesfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $invoice = invoice::find($id);
        return view('invoices.show',compact('invoice'));
    }

    public function show_user_invoice(Request $user_id)
    {
        // echo $user_id->id;die;
        $invoice = invoice::where('id', $user_id->id)->get();
        // print_r($invoice);die;
        return view('invoices.show_user_invoice',compact('invoice'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        $users = User::all();
        return view('invoices.edit',compact('invoice','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $invoices = invoice::find($id);
        $invoices->user_id = $request->input('user_id');
        $invoices->date = $request->input('date');
        $invoices->invoice_date = $request->input('invoice_date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('documents'), $filename);
                $files = $filename; 
                $invoices->invoice_doc = $files;
        }else{
                $invoices->invoice_doc = $invoices->invoice_doc;
        }
        $invoices->amount = $request->input('amount');
        $invoices->invoiceId = $request->input('invoiceId');
        $invoices->save();
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Updated Succesfully !');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */

    public function download($id){
        $invoices = invoice::find($id);
        $fileName = $invoices->invoice_doc;
        $filePath = public_path('documents/'.$fileName);
        $headers = ['Content-Type: application/pdf'];
        if (file_exists($fileName)) {
            return response()->download($filePath, $fileName, $headers);
        } 
        else {
            return redirect()->back()->with('error','File Not Exist!');
        }

    }

    public function upload(){
        // dd('dafs');
        $users = User::all();
        return view('invoices.upload',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('error','Invoice Has Been Deleted  !');
    }


    public function exportIntoExcel(){
        ob_end_clean();
        return Excel::download(new InvoiceExport,'invoicelist.xlsx');
    }

    public function exportIntoExcel_user_invoices(){
        ob_end_clean();
        return Excel::download(new User_invoiceExport,'invoicelist.xlsx');
    }

    public function exportIntoCSV(){
        return Excel::download(new InvoiceExport,'invoicelist.csv'); 
    }
}
