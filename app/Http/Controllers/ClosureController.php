<?php

namespace App\Http\Controllers;

use App\Closure;
use Illuminate\Http\Request;
use App\SysBinaryType;
use App\SysBusiness;
use App\Http\Enum\SysBinaryTypeEnum;
use App\BinaryClosure;
use App\Transactions;
use App\Http\Enum\TransactionsStatusEnum;
use App\Http\Enum\TransactionsTypeEnum;
use Illuminate\Support\Facades\DB;
use App\UserResume;
use App\TransactionStatus;
use App\Http\Enum\SysTransactionOperationTypeEnum;

class ClosureController extends Controller {

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id) {

        DB::beginTransaction();
        $SysBusiness = SysBusinessController::show();
        try {

            if ($SysBusiness->binary === 1) {
                $closure = $this->show($id);
                switch ($SysBusiness->sys_binary_type_id) {
                    case SysBinaryTypeEnum::MAIN:
                        $this->_binary_main($closure);
                        break;
                    case SysBinaryTypeEnum::QUOTES:
                        $this->_binary_quotes($closure);
                        break;
                }
            }
            DB::commit();
            return $SysBusiness;
        } catch (\Exception $exc) {
            DB::rollBack();
            return $exc->getTrace();
        }
    }

    /**
     * 
     * @param type $id
     */
    private function _binary_main($closure) {
        if (count($closure->closure) > 0) {
            foreach ($closure->closure as $binary) {

                $transaction = Transactions::create([
                            'user_id' => $binary->user_id,
                            'type' => TransactionsTypeEnum::BINARY_CLOSURE,
                            'order_item_id' => null,
                            'references_id' => $binary->binary_closure_id,
                            'value' => $binary->less_leg * ($binary->binary_percentage / 100),
                            'status' => TransactionsStatusEnum::SUCCESS,
                            'level' => 0,
                            'description' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::BINARY_CLOSURE],
                            'operation' => SysTransactionOperationTypeEnum::CREDIT
                ]);


                TransactionStatus::create([
                    'transaction_id' => $transaction->id,
                    'status' => $transaction->status
                ]);

                $userResume = UserResume::find($transaction->user_id);
                $userResume->increment('amount', $transaction->value);
                $userResume->increment('amount_bonus', $transaction->value);
            }
        }
    }

    /**
     * 
     * @param type $id
     */
    private function _binary_quotes($closure) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Closure  $closure
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return BinaryClosure::with('closure')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Closure  $closure
     * @return \Illuminate\Http\Response
     */
    public function edit(Closure $closure) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Closure  $closure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Closure $closure) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Closure  $closure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Closure $closure) {
        //
    }

}
