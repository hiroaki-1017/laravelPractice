<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Torihikisaki;

class TorihikisakiController extends Controller
{
    public function torihikisakiGetPage(Request $request)
    {
        $torihikisaki = new Torihikisaki();
        $torihikisaki->data['torihikisaki'] = $request->torihikisaki;
        $torihikisaki->data['torihikisaki_kbn'] = $request->torihikisaki_kbn;

        return $torihikisaki->getPages();
    }
}
