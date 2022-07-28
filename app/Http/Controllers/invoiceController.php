<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

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
        $where_users = "";
        $where_invoiceId = "";
        $where_invoiceId = "";


        if (!empty($request->input('user_ids'))) {
            $user_ids = $request->input('user_ids');
            $string = implode("','", $user_ids);
            $where_users = "WHERE invoices.user_id IN ('".$string."')";
                // echo $where_users;die;
        }

        if (!empty($request->input('invoice_no'))) {
            $invoice_no = $request->input('invoice_no');
            if ($where_users == "") {
                $where_invoiceId = "WHERE invoices.invoiceId = ".$invoice_no."";
            }else{
                $where_invoiceId = "and invoices.invoiceId = ".$invoice_no."";
            }
                // echo $where_invoiceId;die;   
        }

        if (!empty($request->input('date'))) {
            $date = $request->input('date');
            $date = date('Y-m-d', strtotime($date));
            if ($where_users == "" || $where_invoiceId == "" ) {
                $where_date = "WHERE invoices.created_at = '".$date."'";
            }else{
                $where_date = "and invoices.created_at = '".$date."'";
            }
            // echo $where_date;die;
        }else{
            $where_date = "";
        }
                // echo $where_users.' / '.$where_invoiceId.' / '.$where_date;die;
        if ($where_users == "" && $where_invoiceId == "" && $where_date == "") {
            $query = "select * from invoices LEFT JOIN users ON invoices.user_id = users.id;";
        }else{
            $query = "select * from invoices LEFT JOIN users ON invoices.user_id = users.id ${where_users} ${where_invoiceId} ${where_date}";
        }
            //    print_r($query);die;  
        $invoices = DB::select($query);
        $invoices = $this->paginate($invoices);
        $invoices->withPath('http://localhost/bmiportal/public/invoices');
        return view('invoices.index', compact('invoices'));
    }   
    

    public function user_invoices()
    {
        $user = Auth::user();
        // print_r($user->id);die;
        $invoices = invoice::where('user_id',1)->get();
        return view('invoices.user_invoices', ['invoices' => invoice::paginate(5)],compact('invoices'));
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
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('documents'), $filename);
                $files = $filename; 
                $invoices->invoice_doc = $files;
        }
        $invoices->amount = $request->input('amount');
        $invoices->save();
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Added Succesfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,invoice $invoice)
    {
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
        // dd($invoices);
        $fileName = $invoices->invoice_doc;
        $filePath = public_path('documents/'.$fileName);
      $headers = ['Content-Type: application/pdf'];
     return response()->download($filePath, $fileName, $headers);

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

    public function paginate($items, $perPage = 2, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total ,$perPage);
    }
}
