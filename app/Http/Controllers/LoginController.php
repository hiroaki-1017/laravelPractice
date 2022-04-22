<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;

class LoginController extends Controller
{
    public function index(Request $request) {
        $login = new Login();

        // print_r($login->data);

        return view('login', $login->data);
    }
}
