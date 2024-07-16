@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mt-0">投稿一覧</h1>
    <div class="d-flex justify-content-end align-items-center mb-4">
        <form action="{{ route('search') }}" method="GET"  class="align-self-start w-25">
            <div class="form-group">
                <h5>検索</h5>
                <div class="date-group">
                    <label for="startDate">日付</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="startdate" name="start_date" value="{{ request('start_date') }}">
                        ～
                        <input type="date" class="form-control" id="enddate" name="end_date" value="{{ request('end_date') }}">
                    </div>
                </div>
                <label for="username">ユーザー名</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ request('username') }}" placeholder="ユーザー名">

                <label for="text">テキスト</label>
                <textarea class="form-control" id="text" rows="1" name="text" placeholder="テキスト">{{ request('text') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">検索する</button>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('posts.store')}}">
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">投稿</th>
                        <th scope="col">画像</th>
                        <th scope="col">いいね</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post->id) }}" style="color: black;">{{ $post->post }}</a></td>
                        <td><a href="{{ route('posts.show', $post->id) }}" style="color: black;"><img src="{{ asset($post->image) }}" class="img-thumbnail" style="width: 200px; height: auto;"></a></td>
                        <td>                    
                        @if($like_model->like_exist(Auth::user()->id, $post->id))
                        <p class="favorite-mark">
                        <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                        <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                        @else
                        <p class="favorite-mark">
                        <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                        <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
            <a href="{{ route('users.index') }}"><button type="submit" class="btn btn-primary mb-2">マイページ</button></a>
            <a href="{{ route('posts.create') }}"><button type="submit" class="btn btn-primary mb-2">新規投稿</button></a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    var like = $('.js-like-toggle');
    var likePostId;

    like.on('click', function () {
        var $this = $(this);
        likePostId = $this.data('postid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajaxlike',
            type: 'POST',
            data: {
                'post_id': likePostId
            },
        })
        .done(function (data) {
            $this.toggleClass('loved');
            $this.next('.likesCount').html(data.postLikesCount);
        })
        .fail(function (data, xhr, err) {
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
    
        return false;
    });
});
</script>
@endsection
