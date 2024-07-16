@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('posts.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">新規投稿</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="post"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">画像をアップロード</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" onchange="previewImage(event)">
                </div>
                <button type="submit" class="btn btn-primary mb-2">投稿する</button>
            </form>
            <a href="{{ route('posts.index')}}" ><button type="button" class="btn btn-primary mb-2">戻る</button></a>
        </div>
    </div>
</div>
@endsection