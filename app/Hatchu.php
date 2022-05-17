<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hatchu extends Model
{
    protected $table = "hatchu";
    protected $primaryKey = "hatchu_seq";
    public $incrementing = false;
    public $timestamps = false;

    public $data = array(
        "yakuhin_kbn" => "",
        "hatchu_kbn" => "",
        "shori_kbn" => "",
        "shogo_flg" => "",
        "suryo_kbn" => "",
        "tenpo_list" => array(),
        "tenpo_code" => "",
        "date_from" => "",
        "date_to" => "",
        "yakuhin" => "",
        "torihikisaki" => "",
        "page" => 0,
        "list" => array(),
        "hatchu_seq" => "",
        "nendo" => "",
        "tenpo_code" => "",
        "torihikisaki_code" => "",
        "torihikisaki_name" => "",
        "jan_code" => "",
        "yj_code" => "",
        "hanbai_name" => "",
        "hatchu_su" => "",
        "shuryo_kbn" => "",
        "nyuka_su" => "",
        "hatchu_kbn" => "",
        "hatchu_date" => "",
        "shori_kbn" => "",
        "shogo_flg" => "",
        "delete_flg" => "",
        "biko" => "",
        "login_shain_code" => "",
        "title" => "",
        "subtitle" => "",
        "action" => "",
        "button_name" => "",
        "cancel_action" => "",
        "msg" => "",
        "login_kengen_code" => "",
        "txtComplete" => ""
    );

    public function getList()
    {
        $result = self::from('hatchu as h')
            ->join('mst_torihikisaki as mt', 'h.torihikisaki_code', 'mt.torihikisaki_code')
            ->join('mst_torihikisaki as mt2', 'h.tenpo_code', 'mt2.torihikisaki_code')
            ->join('mst_shohin as ms', 'h.jan_code', 'ms.jan_code')
            ->select(
                'h.hatchu_seq',
                'mt.torihikisaki_name',
                'mt2.torihikisaki_name as tenpo_name',
                'h.hatchu_date',
                'h.yakuhin_kbn',
                'ms.hanbai_name',
                'ms.hoso_gryo',
                'h.hatchu_su',
                'h.suryo_kbn',
                'h.hatchu_kbn',
                'h.shogo_flg',
                'h.shori_kbn'
            );
        //yakuhinn_kbn
        if ($this->data['yakuhin_kbn'] != '') {
            $result->where('h.yakuhin_kbn', $this->data['yakuhin_kbn']);
        }

        //tenpo_code
        if ($this->data['tenpo_code'] != '') {
            $result->where('h.tenpo_code', $this->data['tenpo_code']);
        }

        //date_from
        if ($this->data['date_from'] != '') {
            $result->where('h.hatchu_date', $this->data['date_from'] . '00:00:00');
        }

        //date_to
        if ($this->data['date_to'] != '') {
            $result->where('h.hatchu_date', $this->data['date_to'] . '23:59:59');
        }

        //hatchu_kbn
        if ($this->data['hatchu_kbn'] != '') {
            $result->where('h.hatchu_kbn', $this->data['hatchu_kbn']);
        }

        //torihikisaki
        if ($this->data['torihikisaki'] != '') {
            $result->where(function ($result) {
                $result->where('h.torihikisaki_code', $this->data['torihikisaki'])
                    ->orwhere('mt.torihikisaki_name', 'like', '%' . $this->data['torihikisaki'] . '%');
            });
        }

        //yakuhin
        if ($this->data['yakuhin'] != '') {
            $result->where(function ($result) {
                $result->where('h.jan_code', $this->data['yakuhin'])
                    ->orwhere('mt.hanbai_name', 'like', '%' . $this->data['yakuhin'] . '%');
            });
        }

        //マスター照合
        if ($this->data['shogo_flg'] != '') {
            $result->where('h.shogo_flg', $this->data['shogo_flg']);
        }

        $result->orderBy('h.hatchu_date', 'desc');

        $this->data['list'] = $result->paginate(25);
    }

    #葉中登録処理モデル
    public function insertHatchuData()
    {
        //発注日から年度を抽出(10月決算を想定)
        $arrDate = explode('-', $this->data["hatchu_date"]);
        $nendo = $arrDate[0];
        $month = $arrDate[1];
        if ($month <= 10) $nendo--;

        //その年度のmax連番を抽出、そこから新連番を作る
        $seq = self::where('nendo', $nendo)->count();
        $seq++;

        $new_seq = 'h' . $nendo . sprintf('%011d', $seq);
        //echo $new_seq;

        //登録
        $execute = new Hatchu();
        $execute->hatchu_seq = $new_seq;
        $execute->nendo = $nendo;
        $execute->tenpo_code = $this->data["tenpo_code"];
        $execute->torihikisaki_code = $this->data["torihikisaki_code"];
        $execute->yakuhin_kbn = $this->data["yakuhin_kbn"];
        $execute->jan_code = $this->data["jan_code"];
        $execute->yj_code = $this->data["yj_code"];
        $execute->toitsu_code = "";
        $execute->hatchu_su = $this->data["hatchu_su"];
        $execute->suryo_kbn = $this->data["suryo_kbn"];
        $execute->nyuka_su = $this->data["nyuka_su"];
        $execute->hatchu_kbn = $this->data["hatchu_kbn"];
        $execute->hatchu_date = $this->data["hatchu_date"];
        $execute->shori_kbn = $this->data["shori_kbn"];
        $execute->shogo_flg = $this->data["shogo_flg"];
        $execute->delete_flg = "0";
        $execute->biko = $this->data["biko"];
        $execute->created_on = date('Y-m-d H:i:s');
        $execute->created_by = $this->data["login_shain_code"];
        $execute->updated_on = date('Y-m-d H:i:s');
        $execute->updated_by = $this->data["login_shain_code"];
        $execute->save();
    }
}
