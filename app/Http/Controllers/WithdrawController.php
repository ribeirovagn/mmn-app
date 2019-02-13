<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transactions;
use App\Http\Enum\TransactionsTypeEnum;
use App\Http\Enum\SysWithdrawStatus;
use Illuminate\Support\Facades\DB;
use App\TransactionStatus;

class WithdrawController extends Controller {

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
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $Transactions = Transactions::with(['statuses', 'bankDraft', 'user', 'status'])
                ->where('id', $id)
                ->whereIn('type', [TransactionsTypeEnum::WITHDRAW])
                ->first();

        return response([
            'transaction' => $Transactions,
            'statuses' => \App\Http\Enum\SysWithdrawStatus::STATUS
        ]);
    }

    /**
     * 
     * @param int $id
     * @param int $user
     * @return App\Transactions
     * @throws type
     */
    public function showSpecificByUser($id) {
        try {
            $Transactions = Transactions::with(['statuses', 'bankDraft', 'user', 'status', 'withdrawTax'])
                    ->where('id', $id)
                    ->whereIn('type', [TransactionsTypeEnum::WITHDRAW])
                    ->where('user_id', Auth::user()->id)
                    ->first();
            if (!is_null($Transactions)) {
                return response([
                    'transaction' => $Transactions,
                    'statuses' => self::listStatus()
                        ], 200);
            }

            throw \Exception("Withdraw not found!");
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        DB::beginTransaction();

        try {
            $transaction = Transactions::find($id);

            if (in_array($transaction->status, [SysWithdrawStatus::REVERSAL,SysWithdrawStatus::COMPLETED])) {
                throw new \Exception("Can't process!");
            }

            $this->updateStatus($transaction, $request);

            switch ($request->status) {
                case SysWithdrawStatus::REVERSAL :
                    $this->reversal($transaction, $request);
                    break;
            }
            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * 
     * @param type $reversal
     * @param type $request
     */
    protected function reversal($reversal, $request) {

        if (in_array($reversal->status, [SysWithdrawStatus::PROCESSING, SysWithdrawStatus::PENDING])) {

            $userResume = new UserResumeController();
            $userResume = $userResume->show($reversal->user_id);

            $userResume->decrement('withdraw', $reversal->value);
            $userResume->increment('amount', $reversal->value);
            $userResume->increment('reversal', $reversal->value);

            $transaction = Transactions::create([
                        'user_id' => Auth::user()->id,
                        'type' => TransactionsTypeEnum::REVERSAL,
                        'description' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::REVERSAL],
                        'value' => $reversal->value,
                        'related' => $reversal->id,
                        'status' => \App\Http\Enum\SysWithdrawStatus::COMPLETED,
                        'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::CREDIT,
                        'bank_draft_id' => $reversal->bank_draft_id
            ]);

            TransactionStatus::create([
                'transaction_id' => $transaction->id,
                'status' => $transaction->status
            ]);
        }
    }

    /**
     * 
     * @param type $transaction
     * @param type $request
     */
    protected function updateStatus($transaction, $request) {
        $transaction->update([
            'status' => $request->status
        ]);

        \App\TransactionStatus::create([
            'transaction_id' => $transaction->id,
            'status' => $transaction->status,
            'note' => $request->note
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public static function listStatus() {
        return SysWithdrawStatus::STATUS;
    }

}
