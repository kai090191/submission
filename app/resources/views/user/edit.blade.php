@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-md-8">
        <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row align-items-center">
                <div class="col-md-8 mb-3">
                    <label for="exampleFormControlFile1">アイコン</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" onchange="previewImage(event)">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h1>アカウント</h1>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="validationCustom02">名前</label>
                <input type="text" class="form-control" id="validationCustom02" name="name" value="{{ $user->name }}" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">メールアドレス</label>
                <input type="email" class="form-control" id="validationCustom03" name="email" value="{{ $user->email }}" required>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-primary">戻る</a>
                <button class="btn btn-primary" type="submit">編集完了</button>
            </div>
        </form>
    </div>
</div>
@endsection
