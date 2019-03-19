<?php

namespace App\Http\Controllers;

use App\Closure;
use App\BinaryClosure;
use Illuminate\Http\Request;
use App\Http\Enum\BinarySideEnum;
use App\Http\Enum\TypeDotsUnilevel;
use Illuminate\Support\Facades\DB;
use App\Http\Enum\SysBinaryTypeEnum;
use App\Transactions;
use App\UserResume;
use App\Http\Enum\TransactionsStatusEnum;
use App\TransactionStatus;
use Illuminate\Support\Facades\Auth;

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
     * 
     * @return type
     */
    public function store() {
        DB::beginTransaction();

        try {
            $binaryClosure = BinaryClosure::create([
                        'note' => 'Binary Closure'
            ]);


            $dotsBinary = DotsBinaryController::toClosure();


            if (count($dotsBinary) > 0) {

                $sysConfig = \App\SysBusiness::first();

                switch ($sysConfig->sys_binary_type_id) {
                    case SysBinaryTypeEnum::MAIN:
                        $this->default($dotsBinary, $binaryClosure);
                        break;

                    case SysBinaryTypeEnum::QUOTES:
                        $this->quotes($dotsBinary, $binaryClosure);
                        break;

                    default:
                        break;
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $dotsBinary
     * @param type $binaryClosure
     * @throws \Exception
     */
    private function default($dotsBinary, $binaryClosure) {
        try {

            foreach ($dotsBinary as $dot) {
                if ($dot->dots_binary_1 !== $dot->dots_binary_0) {

                    $closure = $this->commons($dot, $binaryClosure);
                    $objTransaction = new \stdClass();
                    $value = $closure->less_leg / (100 / $dot->binary_percentage);

                    $objTransaction->user_id = $dot->user_id;
                    $objTransaction->type = 0;
                    $objTransaction->references_id = 0;
                    $objTransaction->value = $value;

                    $this->transaction($objTransaction);
                }
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * 
     * @param type $dotsBinary
     * @param type $binaryClosures
     */
    public function quotes($dotsBinary, $binaryClosures) {
        $closure = $this->show($id);
    }

    
    /**
     * 
     * @param type $dot
     * @param type $binaryClosure
     * @return type
     * @throws \Exception
     */
    public function commons($dot, $binaryClosure) {
        try {
            $graduationController = new GraduationController();
            $DotsUnilevelController = new DotsUnilevelController();
            $bonusBinary = \App\Bonus::find(\App\Http\Enum\FixedBonusEnum::BINARY_CLOSURE);
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
            return $closure;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    
    /**
     * 
     * @param type $objTransaction
     */
    private function transaction($objTransaction) {

        $transaction = Transactions::create([
                    'user_id' => $objTransaction->user_id,
                    'type' => $objTransaction->type,
                    'references_id' => $objTransaction->references_id,
                    'value' => $objTransaction->value,
                    'status' => TransactionsStatusEnum::SUCCESS,
                    'level' => 0,
                    'description' => 'BINARY CLOSURE',
                    'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::CREDIT
        ]);

        TransactionStatus::create([
            'transaction_id' => $transaction->id,
            'status' => $transaction->status
        ]);


        $userResume = UserResume::find($transaction->user_id);
        $userResume->increment('amount', $transaction->value);
        $userResume->increment('amount_bonus', $transaction->value);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BinaryClosure  $binaryClosure
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return BinaryClosure::with(['closure'])->find($id);
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
    
    
    public function listByUser($user_id = null){
        $user_id = (is_null($user_id)) ? Auth::user()->id : $user_id;
        return Closure::with(['binary_closure', 'graduation', 'statuses'])->where('user_id', $user_id)->get();
    }

}
