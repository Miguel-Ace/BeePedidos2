<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store($idEmpresa){
        auth()->logout();
        // return redirect('/login'.'/'.$idEmpresa);
        return redirect('/');
    }
}
