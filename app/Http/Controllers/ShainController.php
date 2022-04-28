<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shain;

class ShainController extends Controller
{
    public function index(Request $request) {
        $shain = new Shain();
        $shain->makeKengenList();

        return view('shain', $shain->data);
    }
}
