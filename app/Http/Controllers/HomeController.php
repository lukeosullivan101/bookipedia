<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('welcome');
    }

     public function about()
    {

        return view('about');
    }

     public function terms()
    {

        return view('terms');
    }

     public function contact()
    {

        return view('contact');
    }

} //Controller
