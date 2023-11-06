<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function home(){
        return view("site_views/home");
    }
}
