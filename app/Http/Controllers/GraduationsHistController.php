<?php

namespace App\Http\Controllers;

use App\GraduationsHist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduationsHistController extends Controller
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
     * @param  \App\GraduationsHist  $graduationsHist
     * @return \Illuminate\Http\Response
     */
    public function show($user_id = null)
    {
        $user_id = is_null($user_id) ? Auth::user()->id : $user_id;
        return GraduationsHist::where('user_id', $user_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GraduationsHist  $graduationsHist
     * @return \Illuminate\Http\Response
     */
    public function edit(GraduationsHist $graduationsHist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GraduationsHist  $graduationsHist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GraduationsHist $graduationsHist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GraduationsHist  $graduationsHist
     * @return \Illuminate\Http\Response
     */
    public function destroy(GraduationsHist $graduationsHist)
    {
        //
    }
}
