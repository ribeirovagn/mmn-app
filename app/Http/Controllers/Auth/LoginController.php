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
            $req = Request::create('/oauth/token', 'POST', $request->all());
            $res = app()->handle($req);
            $responseBody = $res->getContent();
            $response = json_decode($responseBody, true);

            if (isset($response['error'])) {
                if ($response['error'] === 'invalid_credentials') {
                    throw new \Exception('Dados Inválidos. Tente Novamente.');
                }

                if ($response['error'] === 'invalid_request') {
                    throw new \Exception('Dados Inválidos. Tente Novamente.');
                }
                throw new \Exception($response['error']);
            }

            return $response;
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

}
