<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class History extends Controller
{
    //
    public function historyView(Request $request)
    {
        // $this->onUnauthorized();

        // if ($request->ajax()) {
        // }
        $URL = Http::withToken(Session::get('token'))->get(env('API_HOST') . '/history');

        $data = json_decode($URL->body())->data;
        // dd($data);

        return view('/profile')->with('data', $data);
    }

    public function homeView(Request $request)
    {
        // $this->onUnauthorized();

        // if ($request->ajax()) {
        // }
        $URL = Http::withToken(Session::get('token'))->get(env('API_HOST') . '/history');

        $data = json_decode($URL->body())->data;
        // dd($data);

        return view('/home')->with('data', $data);
    }

    public function predict(Request $request)
    {   
        $response = Http::withToken(Session::get('token'))->post(env('API_HOST').'/history/prediction', $request);
        // dd($response);
        // $response = Http::post(env('API_HOST') . '/prediction', $request);
        $data = json_decode($response->body());
        
        return redirect()->intended('/profile');
    }
}
