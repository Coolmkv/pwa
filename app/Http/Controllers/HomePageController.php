<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    
    public function homePage(Request $request){
        try{
            return view("HomePage.homePage");
        }catch(Exception $exception){
            echo $exception->getMessage();
            return false;
        }

    }
}
