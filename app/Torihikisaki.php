<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torihikisaki extends Model
{
    protected $table = "mst_torihikisaki";
    protected $primaryKey = "torihikisaki_code";
    public $incrementing = false;
    public $timestamps = false;

    public $data = array();

    function getPages()
    {
        $result = self::from('mst_torihikisaki');
        if ($this->data['torihikisaki'] != "") {
            $result->where(function ($result) {
                $result->where('torihikisaki_code', $this->data['torihikisaki'])
                    ->orwhere('torihikisaki_name', 'like', '%' . $this->data['torihikisaki'] . '%');
            });
        }
        if ($this->data['torihikisaki_kbn'] != "") {
            $result->where('torihikisaki_kbn', $this->data['torihikisaki_kbn']);
        }

        return ceil($result->count() / 25);
    }

    function getList()
    {
        $result = self::select('torihikisaki_code', 'torihikisaki_name');
        if ($this->data['torihikisaki'] != "") {
            $result->where(function ($result) {
                $result->where('torihikisaki_code', $this->data['torihikisaki'])
                    ->orwhere('torihikisaki_name', 'like', '%' . $this->data['torihikisaki'] . '%');
            });
        }
        if ($this->data['torihikisaki_kbn'] != "") {
            $result->where('torihikisaki_kbn', $this->data['torihikisaki_kbn']);
        }
        $this->data['list'] = $result->skip(($this->data['page'] - 1) * 25)->take(25)->get();
    }
}
