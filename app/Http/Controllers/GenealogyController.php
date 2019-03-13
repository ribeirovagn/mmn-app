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

    private $normalizedGenealogy = [];

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

            $GenealogyResume = GenealogyResume::find($request->indicator);
            $GenealogyResume->increment('indicated', 1);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * 
     * Display the specified resource.
     *
     * @param  \App\Genealogy  $genealogy
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        $id = is_null($id) ? Auth::user()->id : $id;
        return User::with([
                    'genealogies',
                    'genealogy_statuses',
                    'genealogy_resume',
                    'graduations',
                ])->find($id);
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

    public function family($id = null) {
        $id = (is_null($id)) ? Auth::user()->id : $id;
        return response(Genealogy::with(['children', 'user', 'status', 'resume', 'indicator'])->find($id));
    }

    /**
     * 
     * Recupera a linha de pais de um franqueado
     * @param type $id
     * @return type
     */
    public function getFather($id = null) {
//        $id = is_null($id) ? Auth::user()->id : $id;
        $this->normalizedGenealogy = [];
        $Genealogy = Genealogy::with(['binaryfather', 'nodeAsc', 'user'])->find($id);
        $this->normalizeGenealogy($Genealogy);
        return $this->normalizedGenealogy;
    }

    /**
     * 
     * @param type $Genelogies
     */
    private function normalizeGenealogy($Genelogies) {
        $count = (count($this->normalizedGenealogy));
        $this->normalizedGenealogy[$count] = $Genelogies;
        if (isset($this->normalizedGenealogy[$count]->binaryfather)) {
            $aux = $this->normalizedGenealogy[$count]->binaryfather;
            unset($this->normalizedGenealogy[$count]->binaryfather);
            if (!is_null($aux)) {
                return $this->normalizeGenealogy($aux);
            }
        }
    }

    /**
     * 
     * Recupera a linha de pais de um franqueado
     * @param type $id
     * @return type
     */
    public function getindicador($id = null) {
        $this->normalizedGenealogy = [];
//        $id = is_null($id) ? Auth::user()->id : $id;
        $Genealogy = Genealogy::with(['unilevelindicator', 'indicator', 'user'])->find($id);
        
        $this->normalizeGenealogyUnilevel($Genealogy);
        return $this->normalizedGenealogy;
    }

    /**
     * 
     * @param type $Genelogies
     */
    private function normalizeGenealogyUnilevel($Genelogies) {
        $count = (count($this->normalizedGenealogy));
        $this->normalizedGenealogy[$count] = $Genelogies;
        if (isset($this->normalizedGenealogy[$count]->unilevelindicator)) {
            $aux = $this->normalizedGenealogy[$count]->unilevelindicator;
            unset($this->normalizedGenealogy[$count]->unilevelindicator);
            if (!is_null($aux)) {
                return $this->normalizeGenealogyUnilevel($aux);
            }
        }
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
                    throw new \Exception('Sponsor is not valid!');
                }

                return response([
                    'user' => $user->id,
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

    public function leafs($user_id = null) {
        $user_id = (is_null($user_id)) ? Auth::user()->id : $user_id;
        
        $first =  Genealogy::with(['user', 'leaf0', 'leaf1'])->findOrFail($user_id);
        
        $second['1'] = (isset($first->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($first->leaf0->user_id) : null;
        $second['2'] = (isset($first->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($first->leaf1->user_id) : null;

        $third['1'] = (isset($second['1']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($second['1']->leaf0->user_id) : null;
        $third['2'] = (isset($second['1']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($second['1']->leaf1->user_id) : null;
        $third['3'] = (isset($second['2']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($second['2']->leaf0->user_id) : null;
        $third['4'] = (isset($second['2']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($second['2']->leaf1->user_id) : null;

        $fourth['1'] = (isset($third['1']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['1']->leaf0->user_id) : null;
        $fourth['2'] = (isset($third['1']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['1']->leaf1->user_id) : null;
        $fourth['3'] = (isset($third['2']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['2']->leaf0->user_id) : null;
        $fourth['4'] = (isset($third['2']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['2']->leaf1->user_id) : null;
        $fourth['5'] = (isset($third['3']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['3']->leaf0->user_id) : null;
        $fourth['6'] = (isset($third['3']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['3']->leaf1->user_id) : null;
        $fourth['7'] = (isset($third['4']->leaf0)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['4']->leaf0->user_id) : null;
        $fourth['8'] = (isset($third['4']->leaf1)) ? Genealogy::with(['user', 'leaf0', 'leaf1'])->find($third['4']->leaf1->user_id) : null;
        
        
        return response([
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'fourth' => $fourth,
        ], 200);
        
    }
    
    
    private function isNodeValid(){
        
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
