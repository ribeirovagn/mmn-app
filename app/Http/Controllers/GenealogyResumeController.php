<?php

namespace App\Http\Controllers;

use App\GenealogyResume;
use Illuminate\Http\Request;

class GenealogyResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GenealogyResume::with('user')->get();
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
     * @param  \App\GenealogyResume  $genealogyResume
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GenealogyResume::with('user')->where('user_id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GenealogyResume  $genealogyResume
     * @return \Illuminate\Http\Response
     */
    public function edit(GenealogyResume $genealogyResume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GenealogyResume  $genealogyResume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GenealogyResume $genealogyResume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GenealogyResume  $genealogyResume
     * @return \Illuminate\Http\Response
     */
    public function destroy(GenealogyResume $genealogyResume)
    {
        //
    }
}
