<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $user = Auth::user();
        session(['nombre' => $user->name]);
        return view('home',['titulo'=>'Home']);
    }
}
