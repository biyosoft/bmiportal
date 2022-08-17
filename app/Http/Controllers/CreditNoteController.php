<?php

namespace App\Http\Controllers;

use App\Models\CreditNote;
use App\Models\DeliveryOrder;
use App\Models\User;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditnotes = CreditNote::paginate(2);
        return view('creditnote.index',compact('creditnotes'));
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
        return view('creditnote.create',compact('users','deliveryorders'));
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
            'cn_no' => 'required' ,
            'cn_date' => 'required' ,
            'payment_term' => 'required' ,
        ]);
         
        $creditnotes = new CreditNote();
        $creditnotes->user_id = $request->input('user_id');
        $creditnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $creditnotes->cn_no = $request->input('cn_no');
        $creditnotes->cn_date = $request->input('cn_date');
        $creditnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('documents'), $filename);
               $files = $filename; 
               $creditnotes->cn_doc = $files;
       }
       $creditnotes->save();
       return back()->with('success','New Credit Note is added succefully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditnotes = CreditNote::find($id);
        return view('creditnote.show',compact('creditnotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditNote $creditnote)
    {
        $users = User::all();
        $deliveryorders = DeliveryOrder::all();
        return view('ceditnote.edit',compact('creditnote','users','deliveryorders'));
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
        $creditnotes =CreditNote::find($id);
        $creditnotes->user_id = $request->input('user_id');
        $creditnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $creditnotes->cn_no = $request->input('cn_no');
        $creditnotes->cn_date = $request->input('cn_date');
        $creditnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('documents'), $filename);
               $files = $filename; 
               $creditnotes->cn_doc = $files;
       }
       $creditnotes->save();
       return back()->with('success','Credit Note has been updated succefully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creditnotes = CreditNote::find($id);
        $creditnotes->delete();
        return back()->with('error','The credit note is deleted successfully !');
    }
}
