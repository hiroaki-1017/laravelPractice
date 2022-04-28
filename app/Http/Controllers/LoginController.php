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

    public function putLogin(Request $request) {
        $login = new Login();
        $login->data["shain_code"] = $request->get("shain_code");
        $login->data["password"] = $request->get("password");
        $login->data["tenpo_code"] = $request->get("tenpo_code");

        if(!$login->check()) {
            return view('login',$login->data);
        }

        $session = $request->getSession();
        $session->put("login_shain_code", $login->data["shain_code"]);
        $session->put("login_shain_name", $login->data["shain_name"]);
        $session->put("login_tenpo_code", $login->data["tenpo_code"]);
        $session->put("login_tenpo_name", $login->data["tenpo_name"]);
        $session->put("login_kengen_code", $login->data["kengen_code"]);
        $session->put("login_kengen_name", $login->data["kengen_name"]);

        return redirect("menu");
    }
}
