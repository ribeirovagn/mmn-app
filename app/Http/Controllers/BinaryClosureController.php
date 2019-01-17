<?php

namespace App\Http\Controllers;

use App\Closure;
use App\BinaryClosure;
use Illuminate\Http\Request;
use App\Http\Enum\BinarySideEnum;
use App\Http\Enum\TypeDotsUnilevel;
use Illuminate\Support\Facades\DB;

class BinaryClosureController extends Controller {

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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        DB::beginTransaction();
        try {
            $binaryClosure = BinaryClosure::create([
                        'note' => 'Binary Closure'
            ]);

            $dotsBinary = DotsBinaryController::toClosure();
            $bonusBinary = \App\Bonus::find(\App\Http\Enum\FixedBonusEnum::BINARY_CLOSURE);

            if (count($dotsBinary) > 0) {
                $graduationController = new GraduationController();
                $DotsUnilevelController = new DotsUnilevelController();
                foreach ($dotsBinary as $dot) {
                    if ($dot->dots_binary_1 !== $dot->dots_binary_0) {
                        
                        $lessLeg = ($dot->dots_binary_1 < $dot->dots_binary_0) ? BinarySideEnum::RIGHT : BinarySideEnum::LEFT;
                        $dotsLess = 'dots_binary_' . $lessLeg;
                        
                        $closure = Closure::create([
                                    'binary_closure_id' => $binaryClosure->id,
                                    'user_id' => $dot->user_id,
                                    'dots_binary_0' => $dot->dots_binary_0,
                                    'dots_binary_1' => $dot->dots_binary_1,
                                    'less_leg' => $dot->{$dotsLess},
                                    'dots_unilevel' => $dot->dots_unilevel,
                                    'graduation_id' => $dot->graduations_id,
                                    'status' => $dot->genealogy->status,
                                    'binary_percentage' => $dot->binary_percentage
                        ]);


                        $genealogyResume = \App\GenealogyResume::find($closure->user_id);
                        $genealogyResume->decrement('dots_binary_0', $closure->less_leg);
                        $genealogyResume->decrement('dots_binary_1', $closure->less_leg);

                        $dotsUnilevel = \App\DotsUnilevel::create([
                            'user_id' => $genealogyResume->user_id,
                            'dots' => $closure->{$dotsLess},
                            'status' => $genealogyResume->genealogy->status,
                            'type' => TypeDotsUnilevel::BINARY_CLOSURE,
                            'level' => 0,
                            'references_id' => $binaryClosure->id,
                            'description' => $bonusBinary->name
                        ]);

                        $DotsUnilevelController->sumNewDots($dotsUnilevel);
                        DB::commit();
                    }
                }
            }
            return;
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BinaryClosure  $binaryClosure
     * @return \Illuminate\Http\Response
     */
    public function show(BinaryClosure $binaryClosure) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BinaryClosure  $binaryClosure
     * @return \Illuminate\Http\Response
     */
    public function edit(BinaryClosure $binaryClosure) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BinaryClosure  $binaryClosure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BinaryClosure $binaryClosure) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BinaryClosure  $binaryClosure
     * @return \Illuminate\Http\Response
     */
    public function destroy(BinaryClosure $binaryClosure) {
        //
    }

}
