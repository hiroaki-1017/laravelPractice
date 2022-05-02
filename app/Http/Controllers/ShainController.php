<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shain;

class ShainController extends Controller
{
    public function index(Request $request)
    {
        $shain = new Shain();
        $shain->makeKengenList();

        return view('shain', $shain->data);
    }

    public function kensaku(Request $request)
    {
        $session = $request->getSession();
        $shain = new Shain();
        if (!empty($_GET["page"])) {
            $shain->data = $session->get("shain_data");
        } else {
            $shain = new Shain();
            $shain->data["shain"] = $request->get("shain");
            $shain->data["login_flg"] = $request->get("login_flg");
            $shain->data["kengen_code"] = $request->get("kengen_code");
            $shain->data["delete_flg"] = $request->get("delete_flg");
            $shain->makeKengenList();
            $session->put("shain_data", $shain->data);
        }

        $shain->getList();

        return view('shain', $shain->data);
    }

    public function disNewRegist(Request $request)
    {
        $shain = new Shain();
        $shain->makeKengenList();

        $shain->data["title"] = "社員マスタ新規登録";
        $shain->data["action"] = "checkshaindata";

        return view("shainRegist", $shain->data);
    }

    public function checkShainData(Request $request)
    {
        $shain = new Shain();
        $shain->makeKengenList();
        
        $shain->data["shain_code"] = $request->get("shain_code");
        $shain->data["shain_name"] = $request->get("shain_name");
        $shain->data["shain_name_kana"] = $request->get("shain_name_kana");
        $shain->data["password"] = $request->get("password");
        $shain->data["password2"] = $request->get("password2");
        $shain->data["login_flg"] = $request->get("login_flg");
        $shain->data["mail_address"] = $request->get("mail_address");
        $shain->data["kengen_code"] = $request->get("kengen_code");
        $shain->data["delete_flg"] = $request->get("delete_flg");

        if (!$shain->check()) {
            $shain->data["title"] = "社員マスタ新規登録";
            $shain->data["action"] = "checkshaindata";
            return view('shainRegist', $shain->data);
        }
        
        //確認画面へ
        $shain->data["title"] = "社員データ登録確認";
        $shain->data["action"] = "exeinstshain";

        return view("shainConfilm",$shain->data);
    }

    public function exeInstShain(Request $request) {
        $session = $request->getSession();
        $shain = new Shain();

        $shain->shain_code = $request->get("shain_code");
        $shain->shain_name = $request->get("shain_name");
        $shain->shain_name_kana = $request->get("shain_name_kana");
        $shain->password = $request->get("password");
        $shain->login_flg = $request->get("login_flg");
        $shain->mail_address = $request->get("mail_address");
        $shain->kengen_code = $request->get("kengen_code");
        $shain->biko = "";
        $shain->delete_flg = $request->get("delete_flg");
        $shain->created_on = date('Y-m-d H:i:s');        
        $shain->created_by = $session->get("login_shain_code");
        $shain->updated_on = date('Y-m-d H:i:s');
        $shain->updated_by = $session->get("login_shain_code");


        $shain->save();

        return view("shainComplete");
    }
}
