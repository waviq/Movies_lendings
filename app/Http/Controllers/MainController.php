<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function movies()
    {
        return view('movies.index');
    }

    public function members()
    {
        return view('members.index');
    }

    public function lendings()
    {
        return view('lendings.index');
    }
}
