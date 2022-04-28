<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shain extends Model
{
    protected $table = "mst_shain";
    protected $primaryKey = "shain_code";
    public $incrementing = false;
    public $timestamps = false;

    public $data = array(
        "shain"=>"",
        "login_flg"=>"",
        "kengen_list"=>array(),
        "kengen_code"=>"",
        "delete_flg"=>"",
        "list"=>array()
    );

    public function makeKengenList() {
        $this->data["kengen_list"] = Kengen::select('kengen_code', 'kengen_name')
                                     ->where('delete_flg', '0')->get();
    }
}
