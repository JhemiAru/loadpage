<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class controllerPanel extends Controller
{
    public function log(Request $request)
    {
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
        {   
            return redirect()->route('start-a');
    
        }else{
            return redirect()->route('inicio');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('inicio');
    }
    public function startAdmin() 
    {
        return view('panel.inicio');
    }
}
