<?php

namespace App;

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
}