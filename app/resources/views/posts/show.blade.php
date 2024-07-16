@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <label for="exampleFormControlInput1">投稿詳細</label>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">{{ $post['post'] }}</th>
                            <th><img src="{{ asset($post->image) }}" class="img-thumbnail" style="width: 400px; height: auto;"></th>
                        </tr>
                    </thead>
                </table>
                <label for="exampleFormControlInput1">コメント一覧</label>
                <table class="table table-striped">
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                        <td>{{ $comment->comment }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between gap-1 mb-2">
                <a href="{{ route('report.create', $post['id']) }}" class="btn btn-warning">違反報告</a>
                <form method="get" action="{{ route('posts.edit', $post['id']) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">編集</button>
                </form>
                <form method="post" action="{{ route('posts.destroy', $post['id']) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <a href="{{ route('posts.index') }}" class="btn btn-primary">戻る</a>
            </div>
            <form action="/comment/{{ $post->id }}/comments" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">コメントを追加</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">コメント投稿</button>
            </form>
        </div>
    </div>
</div>
@endsection
