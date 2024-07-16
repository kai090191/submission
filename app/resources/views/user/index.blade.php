@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group  d-flex justify-content-center">
                        @if ($user->image)
                            <img src="{{ asset($user->image) }}" class="img-thumbnail mt-2" style="width: 100px; height: auto;">
                        @else
                            <p>現在のアイコンがありません。</p>
                        @endif
                        <h1>マイページ</h1>
                    </div>
                </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">名前</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">メールアドレス</label>
                        <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group  d-flex justify-content-center">
                    <a href="{{ route('users.create') }}">いいね一覧</a>
                    </div>
                    <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">戻る</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">アカウント編集</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-3">アカウント削除</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
