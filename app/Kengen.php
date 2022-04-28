<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kengen extends Model
{
    protected $table = "mst_kengen";
    protected $primaryKey = "kengen_code";
    public $incrementing = false;
    public $timestamps = false;
}
