<?php

namespace App\Http\Controllers;

use App\UserResume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transactions;
use App\Http\Enum\TransactionsTypeEnum;
use App\TransactionStatus;
use Illuminate\Support\Facades\DB;

class UserResumeController extends Controller {

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
     * @param  \App\UserResume  $userResume
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        $id = (is_null($id) ? Auth::user()->id : $id);
        return UserResume::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserResume  $userResume
     * @return \Illuminate\Http\Response
     */
    public function edit(UserResume $userResume) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserResume  $userResume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserResume $userResume) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserResume  $userResume
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserResume $userResume) {
        //
    }

    /**
     * 
     * @param Request $request
     * @return type
     * @throws \Exception
     */
    public function withdraw(Request $request) {
        try {
            $this->validate($request, [
                'amount' => 'required'
            ]);

            $sysBusiness = \App\SysBusiness::first();

            if ($sysBusiness->withdraw_is_active === 0) {
                throw new \Exception('Withdraw is not active!');
            }

            if ($request->amount <= 0) {
                throw new \Exception('The value must be greater than 0!');
            }

            $totalWithdraw = ($request->amount + $sysBusiness->withdraw_tax);

            DB::beginTransaction();
            $userResume = $this->show();

            if ($userResume->amount >= $totalWithdraw) {

                $userResume->increment('withdraw', $totalWithdraw);
                $userResume->decrement('amount', $totalWithdraw);

                $transaction = Transactions::create([
                            'user_id' => Auth::user()->id,
                            'type' => TransactionsTypeEnum::WITHDRAW,
                            'description' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW],
                            'value' => $request->amount,
                            'status' => \App\Http\Enum\TransactionsStatusEnum::PENDING,
                            'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::DEBIT
                ]);

                TransactionStatus::create([
                    'transaction_id' => $transaction->id,
                    'status' => $transaction->status
                ]);

                if ($sysBusiness->withdraw_tax > 0) {
                    $withdraw_tax = Transactions::create([
                                'user_id' => Auth::user()->id,
                                'type' => TransactionsTypeEnum::WITHDRAW_TAX,
                                'description' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW_TAX],
                                'value' => $sysBusiness->withdraw_tax,
                                'related' => $transaction->id,
                                'status' => \App\Http\Enum\TransactionsStatusEnum::COMPLETED,
                                'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::DEBIT
                    ]);

                    TransactionStatus::create([
                        'transaction_id' => $withdraw_tax->id,
                        'status' => $withdraw_tax->status
                    ]);
                }

                DB::commit();
                return response($userResume, 200);
            }

            throw new \Exception('The amount lees than ' . $totalWithdraw);
        } catch (\Exception $exc) {
            DB::rollBack();
            return response([
                'message' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * 
     */
    public function withdrawByStatus() {
        $statuses = \App\Http\Enum\TransactionsStatusEnum::STATUS;
        $transaction = [];
        foreach ($statuses as $key => $value) {
            $transaction[$value] = Transactions::with(['statuses', 'user'])
                    ->where('status', $key)
                    ->whereIn('type', [TransactionsTypeEnum::WITHDRAW])
                    ->orderBy('created_at', 'desc')
                    ->get();
        }

        return response($transaction, 200);
    }

}
