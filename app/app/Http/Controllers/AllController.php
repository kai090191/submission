<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Posts;

use App\User;

use App\Manege;

use App\Like;

use App\Comment;

use App\Http\Requests\CreateData;


class AllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧画面の表示
    public function index()
    {
        $user = Auth::user();

        // ユーザーが認証されていない場合の処理
        if (!$user) {
            return redirect()->route('login');
        }

        // ユーザーが管理者ロール（IDが1）を持っている場合は管理者画面にリダイレクト
        else if ($user->role == 1) {
            return redirect()->route('manege.index');
        }
        else{

        // 一般ユーザーの場合はポストのリストを表示
        $posts = Posts::where('del_flg', 0)->get();
        
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $posts = Posts::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $like_model = new Like;

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
            ];

        return view('posts.index', compact('posts'), $data);
        }
    
    
    }
    //いいね処理
    public function ajaxlike(Request $request)
    {
        $userId = Auth::user()->id;
        $postId = $request->post_id;
        $like = new Like;
        $post = Posts::findOrFail($postId);
    
        // Check if the user already liked the post
        if ($like->like_exist($userId, $postId)) {
            // If liked, remove the like
            $like->where('post_id', $postId)->where('user_id', $userId)->delete();
        } else {
            // If not liked, add the like
            $like->post_id = $postId;
            $like->user_id = $userId;
            $like->save();
        }
    
        // Get the updated likes count
        $postLikesCount = $post->loadCount('likes')->likes_count;
    
        // Return the updated likes count as JSON
        return response()->json(['postLikesCount' => $postLikesCount]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 登録画面の表示
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 登録処理
    public function store(Request $request)
    {
        //
        $user_id = Auth::id();
        $post = new Posts;
        $post ->user_id = $user_id;
        $post ->post =$request->post;
        // ディレクトリ名
        $dir = 'image';
       
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        
        // 取得したファイル名で保存
        $path = $request->file('image')->storeAs('public/' . $dir, $file_name);
        $post->image = 'storage/' . $dir . '/' . $file_name;


        
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 詳細画面
    public function show($id)
    {
        // Find the specific post by ID
        $post = Posts::findOrFail($id);
    
        // Fetch comments related to the post
        $comments = Comment::where('post_id', $id)->get();
    
        // Create an instance of the Like model
        $like_model = new Like;
    
        // Pass the post, comments, and like_model to the view
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
            'like_model' => $like_model
        ]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 編集画面
    public function edit($id)
    {
        //
        $user_id = Auth::id();
        $post = new Posts;
       
        $eloquent = $post::findOrFail($id);
        return view('posts.edit',[
            'post' =>$eloquent,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新処理
    public function update(Request $request, $id)
    {
        //
        $instance = new Posts;
        $record = $instance->find($id);
                // ディレクトリ名
        $dir = 'image';
       
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        
        // 取得したファイル名で保存
        $path = $request->file('image')->storeAs('public/' . $dir, $file_name);
        $record ->image = 'storage/' . $dir . '/' . $file_name;

        
        
        $record-> post = $request-> post;
        
        $record->save();
        return redirect()->route('posts.index');
    }
    public function updateDelFlg($id)
{
    $post = Posts::findOrFail($id);
    
    // del_flg の切り替え（0から1、1から0に切り替える）
    $post->del_flg = $post->del_flg ? 0 : 1;
    $post->save();
    return redirect()->route('posts.index');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 削除画面
    public function destroy($id)
    {
        //
 
        $post = Posts::findOrFail($id);
        if ($post) {
            $post->del_flg = true;
            $post->save();
        }

        $post->delete();

        return redirect()->route('posts.index');
        
    }
    public function restore($id)
    {
        $post = Posts::findOrFail($id);
        $post->del_flg = false; 
        $post->save();

        return redirect()->route('posts.index');
    }
    public function search(Request $request)
    {
        $startdate = $request->input('start_date');
        $enddate = $request->input('end_date');
        $text = $request->input('text');
        $username = $request->input('username');
    
        // 日付とテキスト検索
        $postsquery = Posts::query();
    
        if ($startdate && $enddate) {
            $postsquery->whereBetween('created_at', [$startdate, $enddate]);
        }
        
        if ($text) {
            $postsquery->where('post', 'like', '%'.$text.'%');
        }
    
        // ユーザー検索
        if ($username) {
            $userquery = User::where('name', 'like', '%'.$username.'%');
            
            // Get user ids matching the username
            $userIds = $userquery->pluck('id')->toArray();
            
            // If users found, add whereHas condition
            if (!empty($userIds)) {
                $postsquery->whereIn('user_id', $userIds);
            }
        }
    
        // 検索結果
        $posts = $postsquery->withCount('likes')->get();
        $like_model = new Like; // Instantiate the Like model
    
        return view('posts.index', [
            'posts' => $posts,
            'like_model' => $like_model,
        ]);
    }
    }
    

