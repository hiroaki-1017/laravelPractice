<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Login {
    public $data = array(
        "shain_code"=>"",
        "shain_name"=>"",
        "password"=>"",
        "tenpo_code"=>"",
        "tenpo_name"=>"",
        "kengen_code"=>"",
        "kengen_name"=>"",
        "msg"=>"",
        "list"=> array()
    );

    //コンストラクタ
    public function __construct()
    {
        $this->data['list'] = Torihikisaki::select('torihikisaki_code','torihikisaki_name')
                                ->where('torihikisaki_kbn','2')
                                ->where('delete_flg','0')->get();
    }

    //チェック用
    public function check() {
        //存在チェック
        $result = DB::table("mst_shain as ms")->join("mst_kengen as mk","ms.kengen_code","mk.kengen_code")
                  ->select("ms.shain_name", "ms.kengen_code", "mk.kengen_name")
                  ->where("ms.shain_code",$this->data["shain_code"])
                  ->where("ms.password",$this->data["password"])->get();  
                  

        echo $result->count();
        if($result->count() == 0) {
            $this->data["msg"] = "社員コードまたはパスワードが違います";
            return false;
        }

        $this->data["shain_name"] = $result[0]->shain_name;
        $this->data["kengen_code"] = $result[0]->kengen_code;
        $this->data["kengen_name"] = $result[0]->kengen_name;

        //関連チェック
        if($this->data["kengen_code"] == "002" && $this->data["tenpo_code"] == "") {
            $this->data["msg"] = "店舗を選択してください";
            return false;
        }

        //店舗情報の整理
        if($this->data["kengen_code"] == "001") {
            $this->data["tenpo_code"] = "";
            $this->data["tenpo_name"] = "";
        } else {
            $result = Torihikisaki::select("torihikisaki_name")
                      ->where("torihikisaki_code",$this->data["tenpo_code"])->get();
            $this->data["tenpo_name"] = $result[0]->torihikisaki_name;
        }

        return true;
    }
}