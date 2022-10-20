<?php

namespace App\Http\Controllers;

use App\Models\attachement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AttachementController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function show(attachement $attachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function edit(attachement $attachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attachement $attachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(attachement $attachement)
    {
        //
    }

    public function getDownload()
    {
        $file= public_path(). "/attachements/Credit Application Form (CC1).pdf";
        return response()->download($file);
    }
}
