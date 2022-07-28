<?php

namespace App\Http\Controllers;

use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use CommonFunctions;
    public function adminLogin(){
        $page_title = "Login";
        return view("Admin.login",compact("page_title"));
    }

    public function dashboard(){
        try{
            return view("Dashboard.dashboard_home");

        }catch(Exception $exception){
            report($exception);
        }
    }
    public function siteNav(Request $request){
        try{
            return view("Dashboard.Pages.site_navigation");

        }catch(Exception $exception){
            report($exception);
        }
    }
    
}
