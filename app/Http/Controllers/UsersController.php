<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Validator;

class UsersController extends Controller
{
    //
    public function profile(){
      $users = Auth::user();
        return view('layouts.profile')->with(
        'users',$users);
    }
/*プロフィール編集の処理*/

    public function profileUpdate(Request $request){
    $validator = Validator::make($request->all(), [
    //'post_title' => 'required|max:255',
    'username' => 'required|max:150',
    'mail' => 'required|max:150',
    'password' => 'required|max:150',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
            return redirect('/profile')
            ->withInput()
            ->withErrors($validator);
        }
        $user_form = $request->all();
        $user = Auth::user();
        //不要な「_token」の削除
        unset($user_form['_token']);
        //保存
        $user->fill($user_form)->save();
        //リダイレクト パスワードはbcryptいるので、別個で一つ一つ記述する　RegisterController参照
        return redirect('/profile');
    }
   /* public function search(Request $request){
        $name=$request->username;
        if($request->isMethod('post')){
            $data = $request->input();
            $name=$data['username'];
            $validator=$this->validator($data);
            if ($validator->fails()) {
            return redirect('/search')
            ->withErrors($validator)
            ->withInput();
        return view('layouts.search')->with('username', $name);
    }
}*/

public function searchForm(){
  //ユーザー情報を取得
  $users = User::All();
  return view('layouts.search')->with(
        'users',$users);//withをくっつけて上記の情報を一緒に持って行く
}



public function search(Request $request) {
    //  $request->isMethod('post')
      $username = $request->username;

     // $data = $request->input();
     // $name=$data['username'];
      if(!empty($username)) {
      $query = User::query();
      $users = $query->where('username','like', '%' .$username. '%')->get();
      $message = "「". $username."」を含む名前の検索が完了しました。";
      return view('layouts.result')->with([
        'users' => $users,
        'message' => $message,
      ]);
    }
    else {
      $message = "検索結果はありません。";
      return view('layouts.result')->with('message',$message);
      }
    }


// フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }


    public function selectUserFindById($id)
{
    // 「SELECT id, name, email WHERE id = ?」を発行する
    $query = $this->select([
        'id',
        'username',
        'mail'
    ])->where([
        'id' => $id
    ]);
    // first()は1件のみ取得する関数
    return $query->first();
}
protected $user;

    /**
     * コンストラクタ
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 画面表示件データ一件取得用
     */
    public function getEdit($id)
    {
        $user = $this->user->selectUserFindById($id);
        // 'users.edit'は後程作成するviewを指定しています。
        return view('layouts.profile', compact('user'));
    }
}
