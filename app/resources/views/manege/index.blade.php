@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-0">ユーザー一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">アイコン</th>
                        <th scope="col">非表示件数</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($manege as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset($user->image) }}" class="img-thumbnail" style="width: 100px; height: auto;" ></td>
                        <!-- <td>{{ $user->del_flg }}</td> -->
                        <td>
                            @php
                                $hiddenCount = $user->posts->where('del_flg', 1)->count();
                            @endphp
                            {{ $hiddenCount }}
                        </td>
                    </tr>
                @endforeach
                </table>
                </tbody>
            </table>
            <a href="{{ route('login') }}"><button type="submit" class="btn btn-primary mb-2">戻る</button></a>
            
            <a href="{{ route('manege.show') }}"><button type="submit" class="btn btn-primary mb-2">投稿一覧</button></a>
        </div>
    </div>
</div>
@endsection
