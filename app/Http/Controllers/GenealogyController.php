<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Genealogy;
use App\GenealogyStatus;
use App\GenealogyResume;
use App\Http\Enum\UserStatusEnum;

class GenealogyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return User::with(['genealogies', 'genealogy_statuses'])->get();
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
    public function store(Request $request, $userCreate) {
        try {

            $genealogy = Genealogy::create([
                        'user_id' => $userCreate->id,
                        'indicator' => $request->indicator,
                        'status' => UserStatusEnum::PENDING
            ]);

            GenealogyStatus::create([
                'status' => $genealogy->status,
                'user_id' => $genealogy->user_id,
            ]);

            GenealogyResume::create([
                'user_id' => $userCreate->id
            ]);
            
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return User::with('genealogies')->with('genealogy_statuses')->find($id);
    }

    /**
     * Display the specified resource. 
     *  
     * @param type $id
     * @return type
     */
    public function indicator($id) {
        return Genealogy::where('indicator', '=', $id)->with('user')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function edit(Genealogy $genealogy) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genealogy $genealogy) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genealogy $genealogy) {
        //
    }

}
