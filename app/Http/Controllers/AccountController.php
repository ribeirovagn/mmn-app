<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankDraft;
use Illuminate\Support\Facades\Auth;
use App\Http\Enum\SysTypeAccountWithdrawEnum;
use Illuminate\Http\Request;
use App\SysTypeAccountWithdraw;

class AccountController extends Controller {

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function storePlataform(Request $request) {
        try {

            $SysTypeAccountWithdraw = SysTypeAccountWithdraw::find(SysTypeAccountWithdrawEnum::PLATAFORM);

            if ($SysTypeAccountWithdraw->is_active === 1) {
                $account = BankDraft::create([
                            'user_id' => Auth::user()->id,
                            'sys_type_account_withdraw_id' => SysTypeAccountWithdrawEnum::PLATAFORM,
                            'account_id' => $request->account_id,
                ]);
                return $this->showPlataform($account->user_id);
            }

            throw new \Exception($SysTypeAccountWithdraw->name . " is not active!");
            
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * 
     * @param int $user_id
     * @return App\BankDraft
     */
    public function showPlataform($user_id = null) {
        $user_id = is_null($user_id) ? Auth::user()->id : $user_id;

        return BankDraft::with(['type_account'])
                        ->where('user_id', $user_id)
                        ->where('sys_type_account_withdraw_id', SysTypeAccountWithdrawEnum::PLATAFORM)
                        ->get();
    }

    /**
     * 
     * @param Request $request
     */
    public function storeCrypto(Request $request) {
        try {
            $SysTypeAccountWithdraw = SysTypeAccountWithdraw::find(SysTypeAccountWithdrawEnum::ADDRESS_CRYPTO);

            if ($SysTypeAccountWithdraw->is_active === 1) {
                $account = BankDraft::create([
                            'user_id' => Auth::user()->id,
                            'crypto_id' => $request->crypto_id,
                            'sys_type_account_withdraw_id' => SysTypeAccountWithdrawEnum::PLATAFORM,
                            'account_id' => $request->account_id,
                ]);
                return $this->showPlataform($account->user_id);
            }

            throw new \Exception($SysTypeAccountWithdraw->name . " is not active!");
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }

    /**
     * 
     * @param int $user_id
     * @return App\BankDraft
     */
    public function showCrypto($user_id = null) {
        $user_id = is_null($user_id) ? Auth::user()->id : $user_id;


        $accounts = BankDraft::with(['type_account', 'crypto'])
                ->where('user_id', $user_id)
                ->where('sys_type_account_withdraw_id', SysTypeAccountWithdrawEnum::ADDRESS_CRYPTO)
                ->get();

        return response([
            'accounts' => $accounts,
            'cryptos' => \App\SysCrypto::all()
        ]);
    }

}
