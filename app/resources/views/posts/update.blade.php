@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mt-0">編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @csrf
            <table class="table table-striped">
            <thead>
                <tr>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post">{{$post['post']}}</textarea>
                <td><img src="{{ asset($post->image) }}" class="img-thumbnail"></td>
                </tr>
            </thead>
            </table>
            <button type="submit" class="btn btn-primary mb-2">編集</button>
        </div>
    </div>
</div>
@endsection