<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\invoice;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $do_no = $request->input('do_no');

        if (!empty($date)) {
            $date = date('Y-m-d', strtotime($date));
        }else{
            $date = "";
        }
        if(!empty($user_id) || !empty($do_no) ){
            $deliveryorders = DeliveryOrder::where('user_id','like','%'.$user_id.'%')
            ->where('do_no','like','%'. $do_no . '%')
            ->paginate(2)
            ->appends(['user_id'=> $user_id, 'do_no' => $do_no]);
        }
        else {
            $deliveryorders = DeliveryOrder::paginate(2);
        }

        return view('deliveryorders.index', compact('deliveryorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = invoice::all();
        $users = User::all();
        return view('deliveryorders.create',compact('users','invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deliveryorders = new DeliveryOrder();
        $deliveryorders->user_id = $request->input('user_id');
        $deliveryorders->do_no = $request->input('do_no');
        $deliveryorders->invoice_id = $request->input('invoice_id');
        $deliveryorders->date = $request->input('date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('documents'), $filename);
                $files = $filename; 
                $deliveryorders->do_doc = $files;
        }
        $deliveryorders->save();
        return redirect()->route('deliveryOrders.index')
        ->with('success','DO has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
       return view('deliveryorders.show',compact('deliveryOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOrder $deliveryOrder)
    {
        $users = User::all();
        return view('deliveryorders.edit',compact('users','deliveryOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $deliveryorders = DeliveryOrder::find($id);
        $deliveryorders->user_id = $request->input('user_id');
        $deliveryorders->do_no = $request->input('do_no');
        $deliveryorders->invoice_id = $request->input('invoice_id');
        $deliveryorders->date = $request->input('date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('documents'), $filename);
                $files = $filename; 
                $deliveryorders->do_doc = $files;
        }
        $deliveryorders->save();
        return redirect()->route('deliveryOrders.index')
        ->with('success','DO has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveryOrder = DeliveryOrder::find($id)->delete();
        return redirect()->route('deliveryOrders.index')
        ->with('error','DO has been deleted  !');
    }


    public function download($id){
        $deliveryOrder = DeliveryOrder::find($id);
        // dd($invoices);
        $fileName = $deliveryOrder->do_doc;
        $filePath = public_path('documents/'.$fileName);
      $headers = ['Content-Type: application/pdf'];
     return response()->download($filePath, $fileName, $headers);

    }

    public function upload(){
        return view('deliveryorders.upload');

    }
    public function upload1(Request $request){
        $request->validate([
            'file' => 'required',
        ]);
        
       $users = User::all();
       $invoices = invoice::all();
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
    return view('deliveryorders.multiDO',compact('users','files','data','invoices'));

    }
    

    public function bulkUpload(Request $request){
        $size = count($request->file);
        // dd($size);
           for($i=0 ; $i<$size ; $i++)
            {
                $deliveryorders = new DeliveryOrder();
                $deliveryorders->user_id = $request->input('user_id')[$i];
                $deliveryorders->date = $request->input('date')[$i];
                if (!empty($request->file[$i])) {
                     $file = $request->file[$i];
                    $filename = time().'-'.$file->getClientOriginalName();  
                    $file->move(public_path('documents'), $filename);
                    $files = $filename; 
                    $deliveryorders->do_doc = $files;
                }
                $deliveryorders->invoice_id = $request->input('invoice_id')[$i];
                $deliveryorders->save();
                
            }
            return redirect()->route('deliveryOrders.index')->with('success','DO Has Been Uploaded Succesfully !');
    }
}
