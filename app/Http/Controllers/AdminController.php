<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function adminLogin(){
        $page_title = "Login";
        return view("Admin.login",compact("page_title"));
    }
}
