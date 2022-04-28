<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
  public function index(Request $request) 
  {
    //セッション
    $session = $request->getSession();
    $menu = new Menu();
    $menu->data["kengen_code"] = $session->get("login_kengen_code");
    $menu->makeMenuList();

    // print_r($menu->data);
    return view("/menu",$menu->data);
  }
}
