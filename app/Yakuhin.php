<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yakuhin extends Model
{
    protected $table = 'mst_shohin';
    protected $primaryKey = 'jan_code';
    public $incrementing = false;
    public $timestamps = false;

    public $data = array();

    public function getPages()
    {
        $result = self::from('mst_shohin');
        //yakuhin
        if ($this->data['yakuhin'] != "") {
            $result->where(function ($result) {
                $result->where('jan_code', $this->data['yakuhin'])
                    ->orwhere('hanbai_name', 'like', '%' . $this->data['yakuhin'] . '%');
            });
        }
        //yakuhin_kbn
        if ($this->data['yakuhin_kbn'] != "") {
            $result->where('yakuhin_kbn', $this->data['yakuhin_kbn']);
        }

        $this->data['list'] = ceil($result->count() / 25);
        return $this->data['list'];
    }

    public function getList()
    {
        $result = self::select('jan_code', 'hanbai_name', 'yakuhin_kbn', 'yj_code');
        //yakuhin
        if ($this->data['yakuhin'] != "") {
            $result->where(function ($result) {
                $result->where('jan_code', $this->data["yakuhin"])
                    ->orwhere('hanbai_name', '%' . $this->data["yakuhin"] . '%');
            });
        }
        //yakuhin_kbn
        if ($this->data['yakuhin_kbn']) {
            $result->where('yakuhin_kbn', $this->data['yakuhin_kbn']);
        }

        $this->data['list'] = $result->skip(($this->data['page'] - 1) * 25)->take(25)->get();
    }
}
