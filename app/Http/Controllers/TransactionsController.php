<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Enum\TransactionsTypeEnum;

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
    public function show($id) {
        return Transactions::with(['statuses'])->where('user_id', '=', Auth::user()->id);
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

        $Transactions = Transactions::with('statuses')
                ->where('user_id', $userID)
                ->whereIn('type', [TransactionsTypeEnum::WITHDRAW, TransactionsTypeEnum::WITHDRAW_TAX])
                ->orderBy('created_at', 'desc')
                ->get();
        return response([
            'transactions' => $Transactions,
            'types' => TransactionsTypeEnum::TYPE,
            'resume' => \App\UserResume::find($userID),
            'statuses' => \App\Http\Enum\TransactionsStatusEnum::STATUS
        ]);
    }

    public function showWithdraw($id) {

        $Transactions = Transactions::with(['statuses', 'related', 'user'])
                ->where('id', $id)
                ->where('type', TransactionsTypeEnum::WITHDRAW)
                ->first();
        return response([
            'transaction' => $Transactions,
            'resume' => \App\UserResume::find($Transactions->user_id),
            'statuses' => \App\Http\Enum\TransactionsStatusEnum::STATUS
        ]);
    }

    /**
     * 
     * @param Request $request
     * @param int $id
     * @return type
     */
    public function updateWithdraw(Request $request, $id) {
        try {
            $transaction = Transactions::find($id);

            $transaction->update([
                'status' => $request->status
            ]);

            \App\TransactionStatus::create([
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
                'note' => $request->note
            ]);
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

}
