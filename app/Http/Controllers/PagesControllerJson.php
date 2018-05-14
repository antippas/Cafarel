<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesControllerJson extends Controller
{
    public function index(){
        //return view("pages.index", compact ("title"));
        return view("index");
    }

    public function bar(){
        //return view("pages.index", compact ("title"));
        return view("vue.index");
    }
}