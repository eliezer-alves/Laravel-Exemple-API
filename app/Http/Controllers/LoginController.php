<?php 
namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	public function index()
	{
		// return view('Login/login', ['name' => 'James']);
		return view('child', ['title' => 'James']);
	}

	public function auth()
	{
		var_dump(Request::all());
	}
}


?>