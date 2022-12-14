<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Level::with('statuses')->get();
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

            $level = Level::create($request->all());

            return response([
                $request->all()
            ]);
        } catch (\Exception $ex) {
            return response([
                'error' => $ex->getMessage()
                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show($product, $type) {
        return Level::with(['statuses', 'bonus'])
                        ->where('product_id', $product)
                        ->where('type', $type)
                        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $level = Level::find($id);
            $level->update($request->all());
            return $level;
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            \App\LevelStatus::where('level_id', '=', $id)->delete();
            Level::find($id)->delete();
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
            ]);
        }
    }

    /**
     * 
     * @param mixed $levelController
     * @param int $levelSearch
     * @return boolean
     */
    public static function betweenNormalize($levelController, $levelSearch) {
        foreach ($levelController as $level) {
            if ($levelSearch >= (int) $level->start && $levelSearch <= (int) $level->end) {
                return $level;
            }
        }

        return false;
    }

    public static function getByProductAndLevel($product, $_level, $type) {
        $levels = Level::with(['product', 'bonus'])
                        ->where('product_id', $product)
                        ->where('type', '=', $type)->get();

        $aux = [];
        
        foreach ($levels as $level) {
            if ($_level >= (int) $level->start && $_level <= (int) $level->end) {
                $aux[] = $level;
            }
        }
        
        return $aux;
    }

}
