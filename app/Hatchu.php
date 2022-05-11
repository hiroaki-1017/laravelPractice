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
        "list" => array()
    );

    public function getList()
    {
        $result = self::from('hatchu as h')
            ->join('mst_torihikisaki as mt', 'h.torihikisaki_code', 'mt.torihikisaki_code')
            ->join('mst_torihikisaki as mt2', 'h.tenpo_code','mt2.torihikisaki_code')
            ->join('mst_shohin as ms', 'h.jan_code', 'ms.jan_code')
            ->select('h.hatchu_seq','mt.torihikisaki_name',
                    'mt2.torihikisaki_name as tenpo_name','h.hatchu_date','h.yakuhin_kbn',
                    'ms.hanbai_name','ms.hoso_gryo','h.hatchu_su','h.suryo_kbn',
                    'h.hatchu_kbn','h.shogo_flg','h.shori_kbn');
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

        $result->orderBy('h.hatchu_date','desc');

        $this->data['list'] = $result->paginate(25);
    }
}
