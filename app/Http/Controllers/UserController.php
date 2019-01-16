<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserResume;
use Illuminate\Support\Facades\DB;
use App\Http\Enum\UserStatusEnum;
use Illuminate\Support\Facades\Auth;
use App\GraduationsHist;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return User::find(Auth::user()->id);
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

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'indicator' => 'required',
            'username' => 'required|unique:users'
        ]);

        DB::beginTransaction();
        
        
        User::findOrFail($request->indicator);
        
        try {

            $userCreate = User::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => $request->email,
                        'password' => bcrypt($request->password)
            ]);

            UserResume::create([
                'user_id' => $userCreate->id
            ]);

            $GenealogyController = new GenealogyController();
            $GenealogyController->store($request, $userCreate);

            GraduationsHist::create([
                'graduation_id' => 1,
                'user_id' => $userCreate->id
            ]);

            DB::commit();

            return response([
                'user' => $GenealogyController->show($userCreate->id)
                    ], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response([
                'error' => $ex->getMessage()
                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return User::find($id);
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
        //
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

    public function logoutApi() {
        if (Auth::check()) {
            return DB::table('oauth_access_tokens')->where('user_id', '=', Auth::user()->id)->delete();
        }
        return response([
            'error' => 'ERROR'
                ], 422);
    }

}
