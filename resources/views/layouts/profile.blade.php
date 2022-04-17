@extends('layouts.login')

@section('content')
@include('common.errors')
    <!-- 投稿フォーム -->
    @if( Auth::check() )
      <form action="{{ url('{id}/profile') }}" method="POST" class="form-horizontal">
<h1>プロフィール</h1>
<form action="{{ url('{id}/profile')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group">
    <div class="user">
    <label>user name</label>
    <input type="text" class="form-control col-md-5" name="username" value={{Auth::user()->username}}></br>
    <label>mail address</label>
    <input type="text" class="form-control col-md-5"  name="mail" value={{Auth::user()->mail}}></br>
    <label>password</label>
    <input type="text" class="form-control col-md-5"  name="password" value={{Auth::user()->password}}></br>
    <label>password confirm</label>
    <input type="text" class="form-control col-md-5"  name="password-confirm" value={{Auth::user()->password}}></br>
    <label>bio</label>
    <input type="text" class="form-control col-md-5"  name="bio" value={{Auth::user()->bio}}></br>
    <label>icon</label>
    <input type="text" class="form-control col-md-5"  name="icon"></br>
    <input type="submit" value="プロフィールを更新する">
  </div>
  </div>

</form>
@endif
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
@endif

@endsection
