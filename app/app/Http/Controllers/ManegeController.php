<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Posts;

class ManegeController extends Controller
{
    //
    public function index()
    {
        $manege = new User();
        $posts = Posts::where('del_flg', true)->get();
        $eloquent = $manege->all();

        return view('manege.index', [
            'manege' => $eloquent,
            'posts' => $posts,
        ]);
    }
    public function show()
    {
        $posts = Posts::all();
        $posts = Posts::withCount('reports')->get();

        // ユーザーデータを投稿数と共に取得
        $users = User::withCount('posts')->take(5)->get();
        return view('manege.show', [
            'posts' => $posts,
            'users'=>$users,
        ]);
    }
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
