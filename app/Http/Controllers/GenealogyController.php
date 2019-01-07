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
use App\Http\Enum\BinarySideEnum;

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
                'user_id' => $userCreate->id,
            ]);

            GenealogyResume::create([
                'user_id' => $userCreate->id
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getTrace());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        $id = is_null($id) ? Auth::user()->id : $id;
        return User::with(['genealogies', 'genealogy_statuses', 'genealogy_resume'])->find($id);
    }

    /**
     * Display the specified resource. 
     *  
     * @param type $id
     * @return type
     */
    public function indicator($id = null) {
        $id = is_null($id) ? Auth::user()->id : $id;
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
     * Testa se um patrocinador é valido
     * 
     * @param type $indicator
     * @return type
     * @throws \Exception
     */
    public function verify($indicator) {
        try {
            $user = User::with(['genealogies', 'genealogy_statuses', 'genealogy_resume'])->where('username', '=', $indicator)->first();
            if (!is_null($user)) {

                $sisBussiness = \App\SysBusiness::first();

                if ((int) $sisBussiness->binary === 1) {
                    if (!is_null($user->genealogies->father) || $user->genealogies->indicator === 0) {
                        return response([
                            'user' => $user->id,
                            'message' => 'Binary is valid'
                                ], 200);
                    }
                    throw new \Exception('Is not valid');
                }

                return response([
                    'user' => $user,
                    'message' => 'Unilevel is valid'
                        ], 200);
            }
            throw new \Exception('Indicator not found');
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
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

            if (!is_null($child->genealogies->father)) {
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

    public static function indicatorsAsc($node) {
        return Genealogy::indicatorsAsc($node);
    }

    public static function nodesAsc($node) {
        return Genealogy::nodesAsc($node);
    }

    /**
     * Altera o lado de um franqueado na rede binaria
     * @param int $id
     * @return type
     * @throws \Exception
     */
    public function changeSide($id) {
        try {
            $genealogy = Genealogy::find($id);

            if ($genealogy->indicator !== Auth::user()->id) {
                throw new \Exception('It\'s not indicated by you.');
            }

            if (!is_null($genealogy->father)) {
                throw new \Exception('Node already positioned!');
            }

            $side = ($genealogy->side === BinarySideEnum::LEFT) ? BinarySideEnum::RIGHT : BinarySideEnum::LEFT;

            $genealogy->update([
                'side' => $side
            ]);

            return response([
                'message' => 'Side changed to ' . BinarySideEnum::SIDE[$side],
                'side' => $side
                    ], 200);
        } catch (\Exception $ex) {
            return response([
                'error' => $ex->getMessage()
                    ], 422);
        }
    }

}
