@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-0">いいね一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">投稿</th>
                            <th scope="col">画像</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($likes as $like)
                        <tr>
                            <td><a href="{{ route('posts.show', ['post' => $like->post->id]) }}" style="color: black;">{{ $like->post->post }}</a></td>
                            <td><img src="{{ asset($like->post->image) }}" class="img-thumbnail" style="width: 200px; height: auto;"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('users.index') }}"><button type="button" class="btn btn-primary mb-2">戻る</button></a>
        </div>
    </div>
</div>
@endsection
