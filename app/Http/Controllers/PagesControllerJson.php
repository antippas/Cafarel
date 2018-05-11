<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesControllerJson extends Controller
{
    public function index(){
        $title="SHARE A BAR";
        //return view("pages.index", compact ("title"));
        return view("index");
    }
}