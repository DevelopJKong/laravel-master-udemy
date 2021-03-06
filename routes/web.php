<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeCotroller;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
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

Route::get('/',[HomeCotroller::class,'home'])->name('home.index');
Route::get('/contact',[HomeCotroller::class,'contact'])->name('home.contact');
Route::get('/single',AboutController::class);;

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false,
        'has_comments' => false
    ]
];

Route::resource('posts',PostsController::class);
    //->only(['index','show','create','store','edit','update']);
//Route::resource('posts',PostsController::class)->except(['index','show']);


//Route::get('/posts', function () use ($posts) {
//    //dd(request()->all());
//    //dd(request()->input('page',1));
//    //dd(request()->query('page',1));
//    // compact($posts) === ['posts' => $posts];
//    return view('posts.index', ['posts' => $posts]);
//});
//
//Route::get('/posts/{id}', function ($id) use ($posts) {
//    abort_if(!isset($posts[$id]), 404);
//    return view('posts.show', ['post' => $posts[$id]]);
//})->name('posts.show');
//
//Route::get('/recent-posts/{days_ago?}', function ($daysAgo) {
//    return 'Posts from' . $daysAgo . ' days ago';
//})->name('posts.recent.index')->middleware('auth');
//
//
//Route::prefix('/fun')->name('fun.')->group(function () use($posts) {
//    Route::get('/responses', function () use ($posts) {
//        return response($posts, 201)
//            ->header('Content-Type', 'application/json')
//            ->cookie('MY_COOKIE', 'Piotr Jura', 3600);
//    })->name('response');
//
//    Route::get('/redirect', function () {
//        return redirect('/contact');
//    })->name('redirect');
//
//    Route::get('/back', function () {
//        return back();
//    })->name('back');
//
//    Route::get('/named-route', function () {
//        return redirect()->route('posts.show', ['id' => 1]);
//    })->name('named-route');
//
//    Route::get('/away', function () {
//        return redirect()->away('https://google.com');
//    })->name('away');
//
//    Route::get('/json', function () use ($posts) {
//        return response()->json($posts);
//    })->name('json');
//
//    Route::get('/download', function () use ($posts) {
//        return response()->download(public_path('/php.png'), 'face.jpg');
//    })->name('download');
//
//
//});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
