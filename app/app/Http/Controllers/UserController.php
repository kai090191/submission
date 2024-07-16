<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Posts;

use App\Like;

use App\Http\Requests\CreateData;

class UserController extends Controller
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
        
        return view('user.index', [
            'user' => $user,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     // 登録画面の表示
     public function create()
     {
         $user_id = Auth::id();
         
         // Fetch liked posts for the authenticated user
         $likes = Like::where('user_id', $user_id)->with('post')->get();
         
         return view('user.create', ['likes' => $likes]);
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
        //
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
        $user = Auth::user();
        return view('user.edit', [
            'user' => $user,
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
        $instance = new User;
        $record = $instance->find($id);
                // ディレクトリ名
        $dir = 'image';
       
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        
        // 取得したファイル名で保存
        $path = $request->file('image')->storeAs('public/' . $dir, $file_name);
        $record ->image = 'storage/' . $dir . '/' . $file_name;
        
        $record->save();
        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);

        $user->delete();
        
        return redirect()->route('home');
    }

}
