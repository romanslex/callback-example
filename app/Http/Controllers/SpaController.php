<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = [
            "name" => auth()->user()->name,
            "email" => auth()->user()->email,
            "total" => auth()->user()->total
        ];
        return view("spa", ["user" => $user]);
    }
}
