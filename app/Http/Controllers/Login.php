<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class Login extends Controller
{
    //      
    public function actionLogin(Request $request)
    {
        $response = Http::post(env('API_HOST') . '/auth/login', $request);
        // dd(json_decode($response->body()));
        if (json_decode($response->body())->success) {
            $data = json_decode($response->body())->data;
            Session::put('token', $data->token);
            Session::put('user', $data->user);
            return redirect()->intended('/home');
        } else {

            return redirect()->intended('/')->withErrors(['msg' => 'test']);
        }
    }

    public function actionLogout()
    {
        $response = Http::withToken(Session::get('token'))->post(env('API_HOST') . '/auth/logout', []);
        Session::flush();
        return redirect()->intended('/');;
    }

    public function actionRegister(Request $request)
    {
        $response = Http::post(env('API_HOST') . '/auth/register', $request);

        // dd($request);
        return back()->with([[
            'data', $response->body()
        ]]);
    }
}
