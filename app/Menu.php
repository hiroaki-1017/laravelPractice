<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Menu
{
  public $data = array(
    "kengen_code" => "",
    "dutiesList" => array(),
    "stokList" => array(),
    "systemList" => array()
  );

  public function makeMenuList()
  {
    //業務リスト
    $this->data["dutiesList"] = DB::table("mst_menu_kengen as mmk")
                                ->join("mst_menu as mm","mmk.menu_code", "mm.menu_code")
                                ->select("menu_name","menu_uri")
                                ->where("mmk.delete_flg","0")
                                ->where("mmk.kengen_code",$this->data["kengen_code"])
                                ->where("mm.menu_kbn", "01")
                                ->orderBy("mmk.hyoji_jun")->get();
    
    //在庫管理リスト
    $this->data["stockList"] = DB::table("mst_menu_kengen as mmk")
                                ->join("mst_menu as mm", "mmk.menu_code", "mm.menu_code")
                                ->select("menu_name", "menu_uri")
                                ->where("mmk.delete_flg", "0")
                                ->where("mmk.kengen_code", $this->data["kengen_code"])
                                ->where("mm.menu_kbn", "02")
                                ->orderBy("mmk.hyoji_jun")->get();
    
    //業務リスト
    $this->data["systemList"] = DB::table("mst_menu_kengen as mmk")
                                ->join("mst_menu as mm", "mmk.menu_code", "mm.menu_code")
                                ->select("menu_name", "menu_uri")
                                ->where("mmk.delete_flg", "0")
                                ->where("mmk.kengen_code", $this->data["kengen_code"])
                                ->where("mm.menu_kbn", "03")
                                ->orderBy("mmk.hyoji_jun")->get();
    
  }
}
