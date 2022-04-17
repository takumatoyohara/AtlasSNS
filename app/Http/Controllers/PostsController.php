<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Validator;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = Post::get();
    return view('posts.index',[
        'posts'=> $posts
    ]);
       //return view('posts.index');
    }
    public function store(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
    //'post_title' => 'required|max:255',
    'post' => 'required|max:150',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
            return redirect('/top')
            ->withInput()
            ->withErrors($validator);
        }
//以下に登録処理を記述（Eloquentモデル）
        $posts = new Post;
      //  $posts->post_title = $request->post_title;
        $posts->post = $request->post;
        $posts->username = Auth::id();//ここでログインしているユーザidを登録しています
        $posts->save();

        return redirect('/top');
    }
    public function delete($id){
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

// ツイート編集処理
    public function update(Request $request, $id)
    {
        //
    }

}
