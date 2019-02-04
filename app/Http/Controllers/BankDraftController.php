<?php

namespace App\Http\Controllers;

use App\BankDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Enum\SysTypeAccountWithdrawEnum;
use App\SysTypeAccountWithdraw;

class BankDraftController extends Controller {

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
        try {

            $SysTypeAccountWithdraw = SysTypeAccountWithdraw::find(SysTypeAccountWithdrawEnum::BANK_ACCOUNT);

            if ($SysTypeAccountWithdraw->is_active === 1) {
                $account = BankDraft::create([
                            'user_id' => Auth::user()->id,
                            'bank_id' => $request->bank_id,
                            'agency' => $request->agency,
                            'sys_type_account_withdraw_id' => SysTypeAccountWithdrawEnum::BANK_ACCOUNT,
                            'account_id' => $request->account_id,
                            'operation' => $request->operation
                ]);

                return $this->show($account->user_id);
            }
            
            throw new \Exception($SysTypeAccountWithdraw->name . " is not active!");
        
        } catch (\Exception $exc) {
            return response([
                'error' => $exc->getMessage()
                    ], 422);
        }
    }
    
        
    public function typesShow($user_id = null){
        $user_id = is_null($user_id) ? Auth::user()->id : $user_id;

        return BankDraft::with(['type_account', 'bank'])
                        ->where('user_id', $user_id)
                        ->get();        
    }

    /**
     * Display the specified resource.
     * @param int $user_id
     */
    public function show($user_id = null) {
        $user_id = is_null($user_id) ? Auth::user()->id : $user_id;

        return BankDraft::with(['type_account', 'bank'])
                        ->where('user_id', $user_id)
                        ->where('sys_type_account_withdraw_id', SysTypeAccountWithdrawEnum::BANK_ACCOUNT)
                        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankDraft  $bankDraft
     * @return \Illuminate\Http\Response
     */
    public function edit(BankDraft $bankDraft) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankDraft  $bankDraft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankDraft $bankDraft) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankDraft  $bankDraft
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankDraft $bankDraft) {
        //
    }
    
    /**
     * 
     * @param Request $request
     */
    public function draft(Request $request){
        
        
          
        
        
    }

}
