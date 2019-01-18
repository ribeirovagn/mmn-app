<?php

namespace App\Http\Controllers;

use App\Graduation;
use App\GraduationsHist;
use App\GenealogyResume;
use Illuminate\Http\Request;

class GraduationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Graduation::with(['levels'])->orderBy('ordinal', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id) {
        $genealogyResumes = GenealogyResume::find($user_id);
        $graduationsHists = GraduationsHist::with('graduation')->where('user_id', $user_id)->orderBy('graduation_id', 'desc')->first();

        if ($genealogyResumes->dots_unilevel > $graduationsHists->graduation->dots_end) {
            $graduations = Graduation::where('ordinal', '>', $graduationsHists->graduation->ordinal)->get();
            foreach ($graduations as $graduation) {

                if ($graduation->dots_start >= $genealogyResumes->dots_unilevel) {
                    break;
                }

                $genealogyResumes->update([
                    'graduations_id' => $graduation->id
                ]);

                GraduationsHist::create([
                    'user_id' => $user_id,
                    'graduation_id' => $graduation->id
                ]);
            }
        }




        return $graduationsHists;
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
    public function update(Request $request, $id) {
        try {
            $graduation = Graduation::find($id);
            $graduation->update($request->all());
            return $graduation;
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
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
