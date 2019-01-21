<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function oauth(Request $request) {
        $this->validate($request, [
            'username' => 'required|email',
            'password' => 'required',
            'grant_type' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
            'recaptcha' => 'required'
        ]);

        try {

            $client = new Client();
            $response = $client->request('POST', env("LOGIN_URL"), [
                'form_params' => $request->all()
            ]);


            if (is_null($response)) {
                throw new \Exception("Sem retorno");
            }

            return response(
                    json_decode($response->getBody(), true)
                    , $response->getStatusCode());
            
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response(['message' => 'Dados não fornecidos. Favor fornecer usuário e senha.'], Response::HTTP_BAD_REQUEST);
            } else if ($e->getCode() === 401) {
                return response(['message' => 'Dados inválidos. Tente novamente.'], Response::HTTP_UNAUTHORIZED);
            }
            return response(['message' => 'Erro interno do servidor.'], $e->getCode());
        }
    }

}
