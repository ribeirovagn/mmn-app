<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Genealogy;
use App\GenealogyStatus;
use App\GenealogyResume;
use App\Http\Enum\UserStatusEnum;
use Carbon\Carbon;

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
        return Genealogy::where('indicator', '=', $id)->with(['user', 'leaf0', 'leaf1'])->get();
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
     * 
     * @param int $user_id
     * @param int $status
     * @return type
     */
    public function updateStatus($user_id, $status) {
        try {
            $genealogy = Genealogy::find($user_id);

            $genealogy->update([
                'status' => $status,
                'date_positioning' => ($status === UserStatusEnum::ACTIVE) ? Carbon::now() : null
            ]);

            GenealogyStatus::create([
                'status' => $genealogy->status,
                'user_id' => $genealogy->user_id
            ]);

            return $this->show($genealogy->user_id);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
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

    /**
     * 
     * @param type $user_id
     * @throws \Exception
     */
    public function binaryPositioning($user_id) {
        try {
            $child = $this->show($user_id);
            
            if(!is_null($child->genealogies->father)){
                throw new \Exception("Node already positioned");
            }
            
            if ($child->genealogies->indicator >= 0) {

                $nodes = Genealogy::lastNode($child->genealogies->side, $child->genealogies->indicator);

                if (count($nodes) === 0) {
                    $parent = $this->show($child->genealogies->indicator);
                } else {
                    $lastChild = end($nodes);
                    $parent = $this->show($lastChild->child);
                }
                
                $child->genealogies->update([
                    'father' => $parent->genealogies->user_id,
                ]);
                
                $parent->genealogies->update([
                    'child_' . $child->genealogies->side => $child->genealogies->user_id
                ]);

                return response([
                    'result' => $parent,
                    'genealogy' => $child,
                ]);
            }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    protected function leafs($user_id) {
        return Genealogy::with(['leaf0', 'leaf1'])->find($user_id);
    }
    
    public static function indicatorsAsc($node){
        return Genealogy::indicatorsAsc($node);
    }

}
