<?php

namespace App\Http\Controllers;

use App\DotsBinary;
use Illuminate\Http\Request;

class DotsBinaryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

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
     * @param  \App\DotsBinary  $dotsBinary
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $sysBusiness = \App\SysBusiness::first();
            if ($sysBusiness->binary === 1) {
                $binary = DotsBinary::where('user_id')->get();
                return response([
                    'binary' => $binary
                ]);
            }
            
            throw new \Exception('Binary is not active');
        
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DotsBinary  $dotsBinary
     * @return \Illuminate\Http\Response
     */
    public function edit(DotsBinary $dotsBinary) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DotsBinary  $dotsBinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DotsBinary $dotsBinary) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DotsBinary  $dotsBinary
     * @return \Illuminate\Http\Response
     */
    public function destroy(DotsBinary $dotsBinary) {
        //
    }

}
