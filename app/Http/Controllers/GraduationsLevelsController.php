<?php

namespace App\Http\Controllers;

use App\GraduationsLevels;
use Illuminate\Http\Request;

class GraduationsLevelsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        
        $this->validate($request, [
            'graduation_level' => 'required',
            'quantity' => 'required'
        ]);
        
        try {
            
            if($request->quantity < 1){
                throw new \Exception('Invalid quantity!');
            }
            
            $graduationLevel = GraduationsLevels::create($request->all());
            return $this->show($graduationLevel->graduation_id);
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GraduationsLevels  $graduationsLevels
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return GraduationsLevels::with(['graduation', 'dependence'])->where('graduation_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GraduationsLevels  $graduationsLevels
     * @return \Illuminate\Http\Response
     */
    public function edit(GraduationsLevels $graduationsLevels) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GraduationsLevels  $graduationsLevels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GraduationsLevels $graduationsLevels) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GraduationsLevels  $graduationsLevels
     * @return \Illuminate\Http\Response
     */
    public function destroy(GraduationsLevels $graduationsLevels) {
        //
    }

}
