<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{

    public function home()
    {
        return view('home');
    }


    public function imprint()
    {
        return view('imprint');
    }

}
