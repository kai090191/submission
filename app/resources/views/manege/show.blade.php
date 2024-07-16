@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-0">投稿管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">非表示ボタン</th>
                        <th scope="col">投稿</th>
                        <th scope="col">画像</th>
                        <th scope="col">違反報告数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td scope="col">
                            <form action="{{ route('posts.updateDelFlg', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-primary" type="submit">非表示</button>
                            </form>
                        </td>
                        <td><a href="{{ route('posts.show', $post->id) }}" style="color: black;">{{ $post->post }}</a></td>
                        <td><img src="{{ asset($post->image) }}" class="img-thumbnail" style="width: 100px; height: auto;"></td>
                        <td scope="col"><td scope="col">{{ $post->reports_count }}</td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('manege.index') }}"><button type="submit" class="btn btn-primary mb-2">戻る</button></a>
        </div>
    </div>
</div>
@endsection
