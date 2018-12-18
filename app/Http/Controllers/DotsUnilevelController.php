<?php

namespace App\Http\Controllers;

use App\DotsUnilevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DotsUnilevelController extends Controller
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
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
   public function show($id = null) {
        try {
            $id = is_null($id) ? Auth::user()->id : $id;
            $sysBusiness = \App\SysBusiness::first();
            if ((int)$sysBusiness->unilevel === 1) {
                $binary = DotsUnilevel::where('user_id', '=', $id)->get();
                return response([
                    'unilevel' => $binary,
                    'genealogy_resume' => \App\GenealogyResume::find($id),
                    'status' => \App\Http\Enum\UserStatusEnum::STATUS,
                ]);
            }
            
            throw new \Exception('Unilevel is not active');
        
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function edit(DotsUnilevel $dotsUnilevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DotsUnilevel $dotsUnilevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DotsUnilevel $dotsUnilevel)
    {
        //
    }
}
