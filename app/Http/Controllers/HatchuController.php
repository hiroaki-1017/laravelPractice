<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hatchu;
use App\Torihikisaki;

class HatchuController extends Controller
{
    public function index(Request $request) {
        //Hatchuモデルのインスタンスを作る
        $hatchu = new Hatchu();
        //Hatchuモデルに店舗選択用のリストを持たせる
        $hatchu->data["tenpo_list"] = Torihikisaki::where('torihikisaki_kbn','2')
                                      ->where('delete_flg','0')->get();
        //画面表示
        return view('hatchu',$hatchu->data);
    }

    public function search(Request $request) {
        //Hatchuモデルのインスタンス,sessionインスタンスを作る
        $session = $request->getSession();
        $hatchu = new Hatchu();
        //リクエストの種類によって処理を分ける
        if(!empty($_GET['page'])) {
            //getリクエストの場合の処理
            //modelのプロパティをsessionから代入
            $hatchu->data = $session->get('hatchuData');
            //ページ情報をプロパティに追加
            $hatchu->data['page'] = $_GET['page'];

        } else {
            //postリクエストの場合の処理
            //リクエストできた画面入力情報をmodelのプロパティに渡す
            $hatchu->data = $request->all();
            //modelに店舗選択ドロップダウンのリストを持たせる
            $hatchu->data["tenpo_list"] = Torihikisaki::where('torihikisaki_kbn','2')
                                                    ->where('delete_flg','0')->get();

            $hatchu->getList();
            //modelのインスタンスをsessionに記憶する
            $session->put('hatchuData',$hatchu->data);
        }
         //ページネーション、一覧表示用のリストを取得する
        $hatchu->getList();
        //画面表示
        return view('hatchu',$hatchu->data);
    }
}
