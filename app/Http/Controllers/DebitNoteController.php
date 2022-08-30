<?php

namespace App\Http\Controllers;

use App\Models\CreditNote;
use App\Models\DebitNote;
use App\Models\DeliveryOrder;
use App\Models\User;
use App\Models\invoice;
use Illuminate\Http\Request;

class DebitNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debitnotes = DebitNote::paginate(2);
        return view('debitnote.index',compact('debitnotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $deliveryorders = DeliveryOrder::all();
        return view('debitnote.create',compact('users','deliveryorders'));
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
            'user_id' => 'required' ,
            'deliveryorder_id' => 'required' ,
            'dn_no' => 'required' ,
            'dn_date' => 'required' ,
            'payment_term' => 'required' ,
        ]);
         
        $debitnotes = new DebitNote();
        $debitnotes->user_id = $request->input('user_id');
        $debitnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $debitnotes->dn_no = $request->input('dn_no');
        $debitnotes->dn_date = $request->input('dn_date');
        $debitnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('documents'), $filename);
               $files = $filename; 
               $debitnotes->dn_doc = $files;
       }
       $debitnotes->save();
       return back()->with('success','New Debit Note is added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debitnotes = DebitNote::find($id);
        return view('debitnote.show',compact('debitnotes'));
    }

    public function upload(){
        $users = User::all();
        return view('debitnote.upload',compact('users'));

    }
    public function bulkupload(Request $request){
        $request->validate([
            'file' => 'required',
        ]);
        $deliveryorders = DeliveryOrder::all();
       $users = User::all();
        $file = $request->file;
         $files = count($request->file);
         foreach($request->file as $file)
            {
                $name=time().'-'.$file->getClientOriginalName();  
                $data[] = $name;  
            }
    return view('debitnote.bulkupload',compact('users','files','data','deliveryorders'));

    }

    public function upload1(Request $request){
        $size = count($request->file);
        for($i=0 ; $i<$size ; $i++)
        {
                $debitnotes = new DebitNote();
                $debitnotes->user_id = $request->input('user_id')[$i];
                $debitnotes->deliveryorder_id = $request->input('deliveryorder_id')[$i];
                $debitnotes->dn_no = $request->input('dn_no')[$i];
                $debitnotes->dn_date = $request->input('dn_date')[$i];
                $debitnotes->payment_term = $request->input('payment_term')[$i];
                if (!empty($request->file[$i])) {
                    $file = $request->file[$i];
                        $filename = time().'-'.$file->getClientOriginalName();  
                    $file->move(public_path('documents'), $filename);
                    $files = $filename; 
                    $debitnotes->dn_doc = $files;
                    }
                $debitnotes->save();
                
            }
            return redirect()->route('debitnotes.index')->with('success','DN Has Been Updated Succesfully !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DebitNote $debitnote)
    {
        $users = User::all();
        $deliveryorders = DeliveryOrder::all();
        return view('debitnote.edit',compact('debitnote','users','deliveryorders'));
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
        $debitnotes = DebitNote::find($id);
        $debitnotes->user_id = $request->input('user_id');
        $debitnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $debitnotes->dn_no = $request->input('dn_no');
        $debitnotes->dn_date = $request->input('dn_date');
        $debitnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('documents'), $filename);
               $files = $filename; 
               $debitnotes->dn_doc = $files;
       }
       $debitnotes->save();
       return back()->with('success','Debit Note has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $debitnotes = DebitNote::find($id);
        $debitnotes->delete();
        return back()->with('error','The debit note is deleted successfully !');
    }
}
