<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torihikisaki extends Model
{
    protected $table = "mst_torihikisaki";
    protected $primaryKey = "torihikisaki_code";
    public $incrementing = false;
    public $timestamps = false;
}
