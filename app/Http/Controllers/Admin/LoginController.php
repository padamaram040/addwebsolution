<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
	public function __construct(){}

	public function index(Request $request){
		return view('admin.auth.login');
	}

	
	public function login(Request $request){
		//echo Hash::make('123123GuruJi'); die();
		$email=$request->email;
		$password=$request->password;
		$credentials=array("email"=>$email,"password"=>$password,"status"=>1);
		if(Auth::attempt($credentials)){
			$user=Auth::user();
			return Redirect::route('admin.dashboard');
		}

		return back()->with('error','Incorret Details');
	}

	public function logout(Request $request){
		Auth::logout();
		return Redirect::route('admin.index');
	}
}