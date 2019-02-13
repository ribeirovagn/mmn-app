<?php

namespace App\Http\Controllers;

use App\Transactions;
use App\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Enum\TransactionsTypeEnum;
use App\Http\Enum\TransactionsStatusEnum;
use App\UserResume;

class TransactionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Transactions::with(['statuses'])->all();
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
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        $id = (is_null($id)) ? Auth::user()->id : $id;
        return Transactions::with(['statuses', 'type', 'operation'])->where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions) {
        //
    }

    public function listWithdraw($id = null) {

        $userID = is_null($id) ? Auth::user()->id : $id;

        $Transactions = Transactions::with(['statuses', 'bankDraft', 'status', 'withdrawTax'])
                ->where('user_id', $userID)
                ->whereIn('type', [TransactionsTypeEnum::WITHDRAW])
                ->orderBy('created_at', 'desc')
                ->get();
        return response([
            'transactions' => $Transactions,
            'resume' => \App\UserResume::find($userID),
            'statuses' => WithdrawController::listStatus()
        ]);
    }

    public function showWithdraw($id) {

        $Transactions = Transactions::with(['statuses', 'withdrawTax', 'user', 'status'])
                ->where('id', $id)
                ->where('type', TransactionsTypeEnum::WITHDRAW)
                ->first();
        return response([
            'transaction' => $Transactions,
            'resume' => \App\UserResume::find($Transactions->user_id),
            'statuses' => WithdrawController::listStatus()
        ]);
    }

    

    /**
     * 
     * @param type $transaction
     * @return type
     */
    public static function paymentOrder($transaction) {
        try {
            $_transaction = Transactions::create([
                        'user_id' => $transaction->user_id,
                        'type' => \App\Http\Enum\TransactionsTypeEnum::PAYMENT,
                        'order_item_id' => $transaction->order_item_id,
                        'references_id' => $transaction->id,
                        'value' => $transaction->value_fiat,
                        'status' => TransactionsStatusEnum::SUCCESS,
                        'level' => 0,
                        'description' => 'ORDER #' . $transaction->id,
                        'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::DEBIT
            ]);

            TransactionStatus::create([
                'transaction_id' => $_transaction->id,
                'status' => $_transaction->status
            ]);

            $userResume = UserResume::find($_transaction->user_id);
            $userResume->decrement('amount', $_transaction->value);
        } catch (\Exception $exc) {
            return $exc->getMessage();
        }
    }

}
