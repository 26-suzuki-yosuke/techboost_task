<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyProfile</title>
    </head>
    <body>
        {{-- layouts/profile.blade.phpを読み込む --}}
        @extends('layouts.profile')
        
        {{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
        @section('title', 'プロフィールの新規作成')

        {{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
        @section('content')
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2>プロフィール新規作成</h2>
                        <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group row">
                                <label class="col-md-2">氏名</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">性別</label>
                                <div class="col-md-10">
                                    <select name="title">
                                        <option value="{{ old('gender') }}" selected>選択してください</option>
                                        <option value="{{ old('gender') }}">男</option>
                                        <option value="{{ old('gender') }}">女</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">趣味</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('hobby') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">自己紹介欄</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="body" rows="20">{{ old('introduction') }}</textarea>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </form>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>