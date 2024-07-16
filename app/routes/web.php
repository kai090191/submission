<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ManegeController;
use App\Http\Controllers\ReportController;
use App\Posts;
use App\User;
use Illuminate\Foundation\Console\Presets\React;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', 'AllController@index')->name('posts.index');
Route::group(['middleware'=>'auth'], function(){
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
Route::post('ajaxlike', 'AllController@ajaxlike')->name('posts.ajaxlike');
// Route::get('/likes', [UserController::class, 'likes'])->name('user.liked_posts');


Route::get('/posts', [AllController::class, 'index'])->name('posts.index');
Route::get('/maneges', [ManegeController::class, 'index'])->name('manege.index');

// Route::get('/posts/{post}/edit', [AllController::class, 'edit'])->name('posts.edit');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts', AllController::class);
Route::resource('users', UserController::class);
//コメント投稿処理
Route::post('/comment/{id}/comments', [CommentController::class, 'store'])->name('comment.store');

//違反報告
Route::get('/reports/create/{id}', [ReportController::class, 'create'])->name('report.create');
Route::post('/report/store/{id}', [ReportController::class, 'store'])->name('report.store');


//管理者投稿一覧
Route::get('/maneges/manege/', [ManegeController::class, 'show'])->name('manege.show');

//del_flgの数字を変える
Route::put('posts/{id}/update-del-flg', 'AllController@updateDelFlg')->name('posts.updateDelFlg');

//検索機能
Route::get('/search', 'AllController@search')->name('search');






});
