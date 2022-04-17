@extends('layouts.login')

@section('content')
<h1>検索条件を入力してください</h1>
<form action="{{ url('/result')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}
  <div class="form-group">
    <label>名前</label>
    <input type="text" class="form-control col-md-5" placeholder="検索したい名前を入力してください" name="username">
  </div>


  <button type="submit" class="btn btn-primary col-md-5">検索</button>
</form>
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>

@endif

<template>
    <span class="float-right">
      <button v-if="!followed" type="button" class="btn-sm shadow-none border border-primary p-2" @click="follow(userId)"><i class="mr-1 fas fa-user-plus"></i>フォロー</button>
      <button  v-else type="button" class="btn-sm shadow-none border border-primary p-2 bg-primary text-white" @click="unfollow(userId)"><i class="mr-1 fas fa-user-check"></i>フォロー中</button>
    </span>
</template>
<!--この下どうすれば？-->

<div style="margin-top:50px;">
<h1>ユーザー一覧</h1>
    <table>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $user)

        <tr>
            <td>{{ $user->username }}</td>
        </tr>
                @if (auth()->user()->isFollowed($user->id))
                    <div class="px-2">
                        <span class="px-1 bg-secondary text-light">フォローされています</span>
                    </div>
                @endif
                <div class="d-flex justify-content-end flex-grow-1">
                    @if (auth()->user()->isFollowing($user->id))
                        <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>
                  @else
                       <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                       {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary">フォローする</button>
                  </form>
                 @endif
              </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="my-4 d-flex justify-content-center">
    {{ $all_users->links() }}
</div>
</div>
</table>
<table class="table">
  <tr>
    <th>ユーザー名</th>
  </tr>
</table>
</div>
@endsection
