<?php

namespace App\Http\Controllers;

use App\Graduation;
use Illuminate\Http\Request;

class GraduationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Graduation::all();
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
        try {
            $input = $request->all();

            if ($input['dots_start'] > $input['dots_end']) {
                throw new \Exception('Score end less than score start!');
            }
            
            return Graduation::create($request->all());
        } catch (Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function show(Graduation $graduation) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduation $graduation) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduation $graduation) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduation $graduation) {
        //
    }

}
