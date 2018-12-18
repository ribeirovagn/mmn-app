<?php

namespace App\Http\Controllers;

use App\Bonus;
use App\SysBusiness;
use App\Transactions;
use App\TransactionStatus;
use App\Http\Enum\TransactionsStatusEnum;
use App\UserResume;
use App\GenealogyResume;
use App\DotsBinary;
use App\DotsUnilevel;

use Illuminate\Http\Request;
use App\Http\Enum\TransactionsTypeEnum;

class BonusController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Bonus::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public static function binary($level, $indicator, $item) {
        Transactions::create([
            'type' => TransactionsTypeEnum::BONUS,
            'order_item_id' => $level->bonus->id,
            'references_id' => $item->id,
            'value' => $level->amount,
            'status' => $indicator->status
        ]);
    }

    public static function unilevel($level, $indicator, $item) {

        if ($level->amount > 0) {

            $transaction = Transactions::create([
                        'user_id' => $indicator->parent,
                        'type' => TransactionsTypeEnum::BONUS,
                        'order_item_id' => $item->id,
                        'references_id' => $level->bonus->id,
                        'value' => $level->amount,
                        'status' => $indicator->status
            ]);
            
            TransactionStatus::create([
                'transaction_id' => $transaction->id,
                'status' => TransactionsStatusEnum::SUCCESS
            ]);

            $userResume = UserResume::find($transaction->user_id);
            $userResume->increment('amount', $transaction->value);
            $userResume->increment('amount_bonus', $transaction->value);
        }

        if ($level->dots_unilevel > 0) {
            $dotsUnilevel = DotsUnilevel::create([
                        'user_id' => $indicator->parent,
                        'dots' => $level->dots_unilevel,
                        'status' => $indicator->status,
                        'type' => 1,
                        'level' => $indicator->level,
                        'references_id' => $item->id,
                        'description' => ''
            ]);

            $genealogyResume = GenealogyResume::find($dotsUnilevel->user_id);
            $genealogyResume->increment('dots_unilevel', $dotsUnilevel->dots);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Bouns::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus) {
        //
    }

}
