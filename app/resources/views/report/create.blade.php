@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('report.store', ['id' => $id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">違反報告</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="report"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">報告する</button>
            </form>
            <a href="{{ route('posts.index') }}">
                <button type="button" class="btn btn-primary mb-2">戻る</button>
            </a>
        </div>
    </div>
</div>
@endsection
