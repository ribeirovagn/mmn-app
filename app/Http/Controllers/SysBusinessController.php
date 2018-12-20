<?php

namespace App\Http\Controllers;

use App\SysBusiness;
use Illuminate\Http\Request;

class SysBusinessController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return SysBusiness::first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SysBusiness  $sysBusiness
     * @return \Illuminate\Http\Response
     */
    public static function show() {
        return SysBusiness::first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SysBusiness  $sysBusiness
     * @return \Illuminate\Http\Response
     */
    public function edit(SysBusiness $sysBusiness) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SysBusiness  $sysBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        try {
            $sysBusiness = SysBusiness::first();
            $sysBusiness->update($request->all());
            return response($sysBusiness, 200);
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SysBusiness  $sysBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy(SysBusiness $sysBusiness) {
        //
    }

}
