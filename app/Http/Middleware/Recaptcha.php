<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class Recaptcha {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {


        if (!env('CAPTCHA_ACTIVE')) {
            return $next($request);
        }
        
        if(!isset($request->recaptcha)){
            throw new Exception('ReCaptcha is not set');
        }

        try {

            $client = new Client();
            $response = $client->request('POST', config('services.recaptcha.siteverify'), [
                'form_params' => [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request->recaptcha,
                    'remoteip' => request('ip')
                ]
            ]);

            $response = json_decode((string) $response->getBody(), true);
            if ($response['success']) {
                return $next($request);
            }

            throw new \Exception("Invalid Recaptcha");
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
