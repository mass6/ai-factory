<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        return view('test')->with(['vars' => session()->all()]);
    }
}
