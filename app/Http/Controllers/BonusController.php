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
use App\Http\Enum\TypeDotsUnilevel;

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

    public function store(Request $request) {
        $bonus = Bonus::create($request->all());
        return $bonus;
    }

    public static function binary($level) {
        $_transaction = [];
        try {
            foreach ($level['levels'] as $_level) {
                if ($_level->amount > 0 && (int) $_level->is_active === 1) {
                    $transaction = Transactions::create([
                                'user_id' => $level['node']->user_id,
                                'type' => TransactionsTypeEnum::BONUS,
                                'order_item_id' => $level['item']->order_id,
                                'references_id' => $_level->bonus->id,
                                'value' => $_level->amount,
                                'status' => TransactionsStatusEnum::SUCCESS,
                                'level' => $level['level'],
                                'description' => 'BINARY - ' . $_level->bonus->name,
                                'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::CREDIT
                    ]);

                    TransactionStatus::create([
                        'transaction_id' => $transaction->id,
                        'status' => $transaction->status
                    ]);

                    self::incrementBonus($transaction, $_level);
                    $_transaction['transactions'][] = $transaction;
                }

                if ((int) $_level->dots > 0 && (int) $_level->is_active === 1) {
                    $DotsBinary = DotsBinary::create([
                                'user_id' => $level['node']->user_id,
                                'status' => $level['node']->status,
                                'order_item_id' => $level['item']->order_id,
                                'references_id' => $_level->bonus->id,
                                'dots' => $_level->dots,
                                'side' => $level['node']->side,
                                'level' => $level['level'],
                                'description' => $_level->bonus->name . " ORDER ITEM #" . $level['item']->order_id
                    ]);

                    if ((int) $DotsBinary->status === \App\Http\Enum\UserStatusEnum::ACTIVE) {
                        $genealogyResume = GenealogyResume::find($DotsBinary->user_id);
                        $genealogyResume->increment('dots_binary_' . $DotsBinary->side, $DotsBinary->dots);
                    }
                    $_transaction['scoreBinary'][] = $DotsBinary;
                }
            }
        } catch (\Exception $ex) {
            throw new \Exception('Bonus Binary: ' . $ex->getMessage());
        }


        return $_transaction;
    }

    /**
     * 
     * @param type $level
     * @param type $indicator
     * @param type $item
     * @throws type
     */
    public static function unilevel($level) {
        $_transaction['node'] = $level['node'];
        try {
            
            $DotsUnilevelController = new DotsUnilevelController();
            
            foreach ($level['levels'] as $_level) {
                if ($_level->amount > 0 && (int) $_level->is_active === 1) {
                    $transaction = Transactions::create([
                                'user_id' => $level['node']->user_id,
                                'type' => TransactionsTypeEnum::BONUS,
                                'order_item_id' => $level['item']->order_id,
                                'references_id' => $_level->bonus->id,
                                'value' => $_level->amount,
                                'status' => TransactionsStatusEnum::SUCCESS,
                                'level' => $level['level'],
                                'description' => 'UNILEVEL - ' . $_level->bonus->name,
                                'operation' => \App\Http\Enum\SysTransactionOperationTypeEnum::CREDIT
                    ]);

                    TransactionStatus::create([
                        'transaction_id' => $transaction->id,
                        'status' => $transaction->status
                    ]);

                    self::incrementBonus($transaction, $_level);
                    $_transaction['transactions'][] = $transaction;
                }


                if ((int) $_level->dots > 0 && (int) $_level->is_active === 1) {
                    $DotsUnilevel = DotsUnilevel::create([
                                'user_id' => $level['node']->user_id,
                                'dots' => $_level->dots,
                                'status' => $level['node']->status,
                                'type' => TypeDotsUnilevel::BONUS,
                                'level' => $level['level'],
                                'references_id' => $_level->bonus->id,
                                'description' => $_level->bonus->name . " ORDER ITEM #" . $level['item']->order_id
                    ]);

                    $DotsUnilevelController->sumNewDots($DotsUnilevel);

                    $_transaction['scoreUnilevel'][] = $DotsUnilevel;
                }
            }
        } catch (\Exception $ex) {
            throw new \Exception('Bonus Unilevel Exception ' . $ex->getMessage());
        }
        return $_transaction;
    }

    /**
     * 
     * @param App\Transaction $transaction
     * @param App\Level $level
     */
    public static function incrementBonus($transaction, $level) {
        if (in_array($level->bonus->id, [\App\Http\Enum\FixedBonusEnum::DIRECT_SALE, \App\Http\Enum\FixedBonusEnum::DIRECT_INDICATION]) || ($transaction->status === \App\Http\Enum\UserStatusEnum::ACTIVE)) {

            $userResume = UserResume::find($transaction->user_id);
            $userResume->increment('amount', $transaction->value);
            $userResume->increment('amount_bonus', $transaction->value);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Bonus::find($id);
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
    public function update(Request $request, $id) {
        try {
            $bonus = Bonus::find($id);
            $bonus->update($request->all());
            return $bonus;
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }

        //
    }

    public function changeActive($id) {
        $bonus = Bonus::find($id);
        $bonus->is_active = ($bonus->is_active === 1) ? 0 : 1;
        $bonus->save();
        return $bonus;
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
