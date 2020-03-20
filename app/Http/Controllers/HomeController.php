<?php

namespace App\Http\Controllers;
use App\User;
use Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            return view('home');
        }
        else{
            $profiles = User::where('type', 'User')->get();
            $companies = User::where('type', 'Company')->get();
            return view('home', compact('profiles', 'companies'));            
        }
    }

    public function welcome()
    {
        return view('welcome');
    }
}