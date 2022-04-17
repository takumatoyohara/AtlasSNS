@extends('layouts.login')
@section('content')
<div class="card-body">
  <div class="card-title">
  </div>
  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
    <!-- 投稿フォーム -->
    @if( Auth::check() )
      <form action="{{ url('top') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <!-- 投稿のタイトル -->
      <div class="form-group">
     <!--   投稿のタイトル
        <div class="col-sm-6">
          <input type="text" name="post_title" class="form-control">
        </div> -->
      </div>
      <!-- 投稿の本文 -->
   <div class="form-group">
        <div class="col-sm-6">
{{ Form::label('投稿を入力してください') }}
{{ Form::text('post',null,['class' => 'input']) }}
        </div>
      </div>
      <!--　登録ボタン -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
    {{ Form::submit('登録') }}

        </div>
      </div>
    </form>
  @endif
</div>
  <!-- 全ての投稿リスト -->
  @if (count($posts) > 0)
    <div class="card-body">
      <div class="card-body">
        <table class="table table-striped task-table">
        <!-- テーブルヘッダ -->
        <thead>
          <th>投稿一覧</th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td class="table-text">
                <div>{{ $post->user->username }}</div>
              </td>
              <td class="table-text">
                <div>{{ $post->post}}</div>
              </td>
              <!-- 投稿者名の表示 -->

              <td>
                <a class="js-modal-open" href="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">編集
                </button>
                <!-- モーダル　-->

              <td>
                <a class="btn btn-primary" href="{{$post->id}}/delete" onclick="return confirm('このレコードを削除します。よろしいでしょうか？')">削除</a>
              </td>
        @endforeach
        <div class="modal js-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal__bg">
                    <div class="modal__content">
                      <div class="modal-header">
                        <button type="button" class="close js-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <form action="">
                          <div class="form-group modal-body">
                            <input type="text" id="recipient-name" value={{$post->post}}>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href>更新</a>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
     </tbody>
    </table>
  </div>
</div>
@endif
@endsection
