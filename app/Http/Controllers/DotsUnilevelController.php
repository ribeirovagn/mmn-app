<?php

namespace App\Http\Controllers;

use App\DotsUnilevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GenealogyResume;
use App\Http\Enum\TypeDotsUnilevel;

class DotsUnilevelController extends Controller {

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
    public function create($level) {
        if ((int) $level->dots > 0 && (int) $level->is_active === 1) {
            $dotsUnilevel = DotsUnilevel::create([
                        'user_id' => $indicator->child,
                        'dots' => $level->dots,
                        'status' => $indicator->status,
                        'type' => TypeDotsUnilevel::BONUS,
                        'level' => $indicator->level,
                        'references_id' => $item->id,
                        'description' => $level->bonus->name
            ]);
            $this->sumNewDots($dotsUnilevel);
        }
    }

    /**
     * Incrementa os pontos e qualifica o usuario se o mesmo estiver ativo
     * @param mixed $dotsUnilevel
     */
    public function sumNewDots($dotsUnilevel) {
        if ((int) $dotsUnilevel->status === \App\Http\Enum\UserStatusEnum::ACTIVE) {
            $genealogyResume = GenealogyResume::find($dotsUnilevel->user_id);
            $genealogyResume->increment('dots_unilevel', $dotsUnilevel->dots);
            $graduationController = new GraduationController();
            $graduationController->create($dotsUnilevel->user_id);
            return $this;
        }
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
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        try {
            $id = is_null($id) ? Auth::user()->id : $id;
            $sysBusiness = \App\SysBusiness::first();
            if ((int) $sysBusiness->unilevel === 1) {
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
    public function edit(DotsUnilevel $dotsUnilevel) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DotsUnilevel $dotsUnilevel) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DotsUnilevel  $dotsUnilevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DotsUnilevel $dotsUnilevel) {
        //
    }

}
