<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hatchu;
use App\Torihikisaki;
use App\Yakuhin;

class HatchuController extends Controller
{
    public function index(Request $request)
    {
        //Hatchuモデルのインスタンスを作る
        $hatchu = new Hatchu();
        //Hatchuモデルに店舗選択用のリストを持たせる
        $hatchu->data["tenpo_list"] = Torihikisaki::where('torihikisaki_kbn', '2')
            ->where('delete_flg', '0')->get();
        //画面表示
        return view('hatchu', $hatchu->data);
    }

    public function search(Request $request)
    {
        //Hatchuモデルのインスタンス,sessionインスタンスを作る
        $session = $request->getSession();
        $hatchu = new Hatchu();
        //リクエストの種類によって処理を分ける
        if (!empty($_GET['page'])) {
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
            $hatchu->data["tenpo_list"] = Torihikisaki::where('torihikisaki_kbn', '2')
                ->where('delete_flg', '0')->get();

            $hatchu->getList();
            //modelのインスタンスをsessionに記憶する
            $session->put('hatchuData', $hatchu->data);
        }
        //ページネーション、一覧表示用のリストを取得する
        $hatchu->getList();
        //画面表示
        return view('hatchu', $hatchu->data);
    }

    public function dispShinki(Request $request)
    {
        $hatchu = new Hatchu();
        //modelに店舗選択ドロップ弾雨用のリストを持たせる
        $hatchu->data["tenpo_list"] = Torihikisaki::where('torihikisaki_kbn', '2')
            ->where('delete_flg', '0')->get();

        $hatchu->data["title"] = "発注データ新規作成";
        $hatchu->data['action'] = "hatchuconfil";
        return view('hatchuRegist', $hatchu->data);
    }

    public function hatchuConfilm(Request $request)
    {
        $hatchu = new Hatchu();
        $request->validate([
            "torihikisaki_name" => 'required',
            "hatchu_date" => 'required',
            "hanbai_name" => 'required',
            "hatchu_su" => 'required'
        ]);
    }

    public function torihikisakiSansho(Request $request)
    {
        $session = $request->getSession();
        $hatchu = new Hatchu();
        $hatchu->data['list'] = array();
        return view('torihikisakiSansho', $hatchu->data);
    }

    public function torihikisakiGetPage(Request $request)
    {
        $torihikisaki = new Torihikisaki();
        $torihikisaki->data['torihikisaki'] = $request->torihikisaki;
        $torihikisaki->data['torihikisaki_kbn'] = $request->torihikisaki_kbn;

        return $torihikisaki->getPages();
    }

    public function torihikisakiGetList(Request $request)
    {
        $torihikisaki = new Torihikisaki();
        $torihikisaki->data['torihikisaki'] = $request->torihikisaki;
        $torihikisaki->data['torihikisaki_kbn'] = $request->torihikisaki_kbn;
        $torihikisaki->data['_token'] = $request->_token;
        $torihikisaki->data['page'] = $request->page;
        $torihikisaki->getList();
        return view('torihikisakiSanshoList', $torihikisaki->data);
    }

    public function yakuhinSansho(Request $request)
    {
        return view('yakuhinSansho');
    }

    public function yakuhinGetPage(Request $request)
    {
        $yakuhin = new Yakuhin();
        $yakuhin->data['yakuhin'] = $request->yakuhin;
        $yakuhin->data['yakuhin_kbn'] = $request->yakuhin_kbn;

        return $yakuhin->getPages();
    }

    public function yakuhinGetList(Request $request)
    {
        $yakuhin = new Yakuhin();
        $yakuhin->data['yakuhin'] = $request->yakuhin;
        $yakuhin->data['yakuhin_kbn'] = $request->yakuhin_kbn;
        $yakuhin->data['_token'] = $request->_token;
        $yakuhin->data['page'] = $request->page;
        $yakuhin->getList();
        return view('yakuhinSanshoList', $yakuhin->data);
    }
}
