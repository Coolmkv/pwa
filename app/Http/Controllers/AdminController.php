<?php

namespace App\Http\Controllers;

use App\Models\NavMenu;
use App\Models\User;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
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
            $this->reportException($exception);
        }
    }
    public function siteNav(Request $request){
        try{
            return view("Dashboard.Pages.site_navigation");

        }catch(Exception $exception){
            $this->reportException($exception);
        }
    }
    
    public function Login()
    {
        try{
            return view("Admin.adminLogin");

        }catch(Exception $exception){
            $this->reportException($exception);
        }
    }

    public function AdminLoginUser(Request $request){
        try{

            $validate = Validator::make($request->all(),[
                User::EMAIL=>"bail|required|email",
                "password"=>"bail|required"
            ]);
            if($validate->fails()){
                $return = redirect()->back()->withInput()->with("error",$validate->getMessageBag()->first());
            }else{
                $findUser = User::where([
                        [User::EMAIL,$request->input(User::EMAIL)]
                    ])->first();
                if(empty($findUser)){
                    $return = redirect()->back()->withInput()->with("error","Invalid details");
                }else if(Auth::attempt(['email' => $request->input(User::EMAIL), 'password' => $request->input(User::PASSWORD)])){
                    $request->session()->regenerate();                    
                    $return = redirect("new-dashboard");
                }else{
                    $return = redirect()->back()->withInput()->with("error","Invalid details");
                }    
            }
             
            return $return;
        }catch(Exception $exception){
            $this->reportException($exception);
        }
    }    
    /**
     * addEditNavigation
     *
     * @param  mixed $request
     * @return void
     */
    public function addEditNavigation(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                NavMenu::TITLE=>"bail|string|required_if:action,insert,update",
                NavMenu::URL=>"bail|required_if:action,insert,update|string",
                NavMenu::URL_TARGET=>"bail|nullable|string|in:_blank,_self,_parent,_top",
                NavMenu::NAV_TYPE=>"bail|required_if:action,insert,update|string|in:mobile,top,footer",
                NavMenu::VIEW_IN_LIST=>"bail|required_if:action,insert,update|in:yes,no",
                NavMenu::POSITION=>"bail|nullable|numeric",
                "action"=>"required|in:insert,delete,update",
                NavMenu::ID=>"required_if:action,delete,update"
            ]);
            if($validate->fails()){
                $return = redirect()->back()->withInput()->with("error",$validate->getMessageBag()->first());
            }else{
                
                if($request->input("action")=="insert"){
                    $return = (new NavMenu())->insertNavMenu($request->all());
                }elseif($request->input("action")=="update"){
                    $return = (new NavMenu())->updateNavMenu($request->all());
                }elseif($request->input("action")=="delete"){
                    $return = (new NavMenu())->deleteNavMenu($request->all());
                }else{
                    $return = ["status"=>false,"message"=>"Invalid action","data"=>null];
                }
                if($return["status"]){
                    $return = redirect()->back()->withInput()->with("success",$return["message"]);
                }else{
                    $return = redirect()->back()->withInput()->with("error",$return["message"]);
                }                
            }
            return $return;
        }catch(Exception $exception){
            $this->reportException($exception);
        }
    }

    public function navDataTable(){
        $data = NavMenu::select(NavMenu::ID,
        NavMenu::URL,
        NavMenu::URL_TARGET,
        NavMenu::TITLE,
        NavMenu::NAV_TYPE,
        NavMenu::POSITION,
        NavMenu::VIEW_IN_LIST
        );

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" onclick="edit(\''.$row->{NavMenu::ID}.'\')" class="edit btn btn-primary btn-sm">Edit</a>'.
                           '<a href="javascript:void(0)" onclick="delete(\''.$row->{NavMenu::ID}.'\')" class="edit btn btn-danger btn-sm">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
    
}
