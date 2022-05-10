<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shain extends Model
{
    protected $table = "mst_shain";
    protected $primaryKey = "shain_code";
    public $incrementing = false;
    public $timestamps = false;

    public $data = array(
        "shain" => "",
        "login_flg" => "",
        "kengen_list" => array(),
        "kengen_code" => "",
        "delete_flg" => "",
        "list" => array(),
        "shain_code" => "",
        "shain_name" => "",
        "shain_name_kana" => "",
        "password" => "",
        "password2" => "",
        "mail_address" => "",
        "kengen_name" => "",
        "title" => "",
        "action" => "",
        "mgs" => "",
        "edit" => ""

    );

    public function makeKengenList()
    {
        $this->data["kengen_list"] = Kengen::select('kengen_code', 'kengen_name')
            ->where('delete_flg', '0')->get();
    }

    public function getList()
    {
        $result = DB::table("mst_shain as ms")
            ->join("mst_kengen as mk", "ms.kengen_code", "mk.kengen_code")
            ->select(
                "ms.shain_code",
                "ms.shain_name",
                "ms.login_flg",
                "ms.mail_address",
                "mk.kengen_name",
                "ms.delete_flg"
            );

        //shain
        if ($this->data["shain"] != "") {
            $result->where(function ($result) {
                $result->where("ms.shian_code", $this->data["shain"])
                    ->orwhere("ms.shain_name", "like", "%" . $this->data["shain"] . "%")
                    ->orwhere("ms.shain_name_kana", "like", "%" . $this->data["shain"] . "%");
            });
        }

        //login_flg
        if ($this->data["login_flg"] != "") {
            $result->where("ms.login_flg", $this->data["login_flg"]);
        }

        //kengen_code
        if ($this->data["kengen_code"] != "") {
            $result->where("ms.kengen_code", $this->data["kengen_code"]);
        }

        //delete_flg
        if ($this->data["delete_flg"] != "") {
            $result->where("ms.delete_flg", $this->data["delete_flg"]);
        }

        //orderBy
        $result->orderBy("ms.shain_code");

        //ページネーション
        $this->data["list"] = $result->paginate(25);
    }

    public function check()
    {
        //存在チェック
        if ($this->data['edit'] == "") {

            $result = Shain::where('shain_code', $this->data['shain_code'])->count();

            if ($result != 0) {
                $this->data["msg"] = "この社員コードはすでに使用済みです。";
                return false;
            }
        }

        if ($this->data["password"] != $this->data["password2"]) {
            $this->data["msg"] = "パスワードと確認用のパスワードが一致していません";
            return false;
        }

        return true;
    }

    public function getShainData()
    {
        $result = self::where('shain_code', $this->data['shain_code'])->first();

        $this->data['shain_name'] = $result->shain_name;
        $this->data['shain_name_kana'] = $result->shain_name_kana;
        $this->data['password'] = $result->password;
        $this->data['login_flg'] = $result->login_flg;
        $this->data['mail_address'] = $result->mail_address;
        $this->data['kengen_code'] = $result->kengen_code;
        $this->data['delete_flg'] = $result->delete_flg;
    }
}
