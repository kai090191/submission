@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('posts.store')}}">
            @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">新規投稿</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="posts"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">投稿する</button>
            </form>
        </div>
    </div>
</div>
@endsection