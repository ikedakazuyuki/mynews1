<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

// 追記
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('updated_at');
        //News::all()はEloquentを使った全てのnewsテーブルを取得するメソッド//
        //sortBy(‘xxx’)：xxxで昇順に並べ換える。//        
        //sortByDesc(‘xxx’)：xxxで降順に並べ換える。//
        if (count($posts) > 0) {
            $headline = $posts->shift();

            //shift()メソッドは、配列の最初のデータを削除し、その値を返すメソッド//

            /*例）
            $collection = array(“a”,”b”,”c”,”d”);
            $collection>shift();
            →”a”
            $collection->all();
            →array(“b”,”c”,”d”)*/

        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
