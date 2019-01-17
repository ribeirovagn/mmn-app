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

    public function store(Request $request) {
        $bonus = Bonus::create($request->all());
        return $bonus;
    }

    public static function binary($level, $indicator, $item) {
        $_transaction['level'] = $level;
        $_transaction['indicator'] = $indicator;
        $_transaction['item'] = $item;

        try {
            if ($level->amount > 0 && (int)$level->is_active === 1) {

                $transaction = Transactions::create([
                            'user_id' => $indicator->child,
                            'type' => TransactionsTypeEnum::BONUS,
                            'order_item_id' => $item->id,
                            'references_id' => $level->bonus->id,
                            'value' => $level->amount,
                            'status' => $indicator->status,
                            'level' => $indicator->level
                ]);

                TransactionStatus::create([
                    'transaction_id' => $transaction->id,
                    'status' => TransactionsStatusEnum::SUCCESS
                ]);

                $userResume = UserResume::find($transaction->user_id);
                $userResume->increment('amount', $transaction->value);
                $userResume->increment('amount_bonus', $transaction->value);

                $_transaction['transaction'] = $transaction;
                $_transaction['user_resume'] = $userResume;
            }

            if ((int) $level->dots > 0 && (int)$level->is_active === 1) {
                
                
                $genealogy = \App\Genealogy::find($indicator->parent);
                
                $DotsBinary = DotsBinary::create([
                            'user_id' => $indicator->child,
                            'status' => $indicator->status,
                            'description' => '',
                            'order_item_id' => $item->id,
                            'dots' => $level->dots,
                            'side' => $genealogy->side,
                            'level' => $indicator->level,
                            'description' => $level->bonus->name
                ]);


                $genealogyResume = GenealogyResume::find($DotsBinary->user_id);
                $genealogyResume->increment('dots_binary_' . $DotsBinary->side, $DotsBinary->dots);

                $_transaction['scoreBinary'] = $DotsBinary;
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
    public static function unilevel($level, $indicator, $item) {

        try {
            if ($level->amount > 0) {

                $transaction = Transactions::create([
                            'user_id' => $indicator->parent,
                            'type' => TransactionsTypeEnum::BONUS,
                            'order_item_id' => $item->id,
                            'references_id' => $level->bonus->id,
                            'value' => $level->amount,
                            'status' => $indicator->status,
                            'level' => $indicator->level,
                ]);

                TransactionStatus::create([
                    'transaction_id' => $transaction->id,
                    'status' => TransactionsStatusEnum::SUCCESS
                ]);

                $userResume = UserResume::find($transaction->user_id);
                $userResume->increment('amount', $transaction->value);
                $userResume->increment('amount_bonus', $transaction->value);
            }
        } catch (\Exception $ex) {
            throw new \Exception('Bonus Unilevel Exception');
        }

        $DotsUnilevelController = new DotsUnilevelController();
        $DotsUnilevelController->create($level, $indicator, $item);
        $DotsUnilevelController->show($level, $indicator, $item);
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
    public function update(Request $request, Bonus $bonus) {
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
