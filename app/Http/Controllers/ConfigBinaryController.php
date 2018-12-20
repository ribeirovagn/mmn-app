<?php

namespace App\Http\Controllers;

use App\ConfigBinary;
use Illuminate\Http\Request;
use App\Http\Enum\ConfigBinaryEnum;

class ConfigBinaryController extends Controller
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
    
    public function schedule(){
        return ConfigBinaryEnum::SCHEDULY;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConfigBinary  $configBinary
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigBinary $configBinary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigBinary  $configBinary
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigBinary $configBinary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigBinary  $configBinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigBinary $configBinary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigBinary  $configBinary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigBinary $configBinary)
    {
        //
    }
}
