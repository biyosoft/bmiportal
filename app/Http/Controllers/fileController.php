<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\UploadFile;
use App\Models\User;
use Smalot\PdfParser\Parser;

use Illuminate\Http\Request;

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
        // dd($size);
           for($i=0 ; $i<$size ; $i++)
            {
                $invoices = new invoice();
                $invoices->user_id = $request->input('user_id')[$i];
                $invoices->date = $request->input('date')[$i];
                if (!empty($request->file[$i])) {
                     $file = $request->file[$i];
                    $filename = time().'-'.$file->getClientOriginalName();  
                    $file->move(public_path('documents'), $filename);
                    $files = $filename; 
                    $invoices->invoice_doc = $files;
                }
                $invoices->amount = $request->input('amount')[$i];
                $invoices->invoiceId = $request->input('invoiceId')[$i];
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
         foreach($request->file as $file)
            {
                $name=time().'-'.$file->getClientOriginalName();  
                $data[] = $name;  
            }
        // use of pdf parser to read content from pdf 
    //     $fileName = $file->getClientOriginalName();

    //     $pdfParser = new Parser();
    //     $pdf = $pdfParser->parseFile($file->path());
    //     $content = $pdf->getText();
    //     $skuList = preg_split('/\r\n|\r|\n/', $content);
    //    dd($skuList);
    //    $upload_file = new UploadFile();
    //    dd($fileName);
    //   $upload_file->user_id = $request->user_id;
    //    $upload_file->orig_filename = $fileName; 
    //    $upload_file->mime_type = $file->getMimeType();
    //    $upload_file->filesize = $file->getSize();
    //    $upload_file->content = $content;
    //    $upload_file->save();
    return view('invoices.bulk-invoice',compact('users','files','data'));
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
