@extends('layouts.login')

@section('content')
{{$message}}

@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
@endif
<div style="margin-top:50px;">
<h1>ユーザー一覧</h1>
@foreach($users as $user)
{{$user->username}}
<button type="submit" class="btn btn-primary col-md-5">フォローする</button>
<button type="submit" class="btn btn-primary col-md-5">フォローを外す</button></br>
@endforeach
<table class="table">
  <tr>
    <th>ユーザー名</th>
  </tr>


</table>
</div>
@endsection
