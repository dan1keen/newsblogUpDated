<?php

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



Route::get('/news', 'NewsController@news');
Route::get('/news/{id}', 'NewsController@show');
Route::get('/form', 'NewsController@create');
Route::resource('shares', 'NewsController');
Route::get('/edit/{id}', 'NewsController@edit');
Route::get('/search', 'NewsController@search');
Route::get('/sort', 'NewsController@sort');
// Route::get('image-upload', 'NewsController@imageUpload')->name('image.upload');
// Route::post('image-upload', 'NewsController@imageUploadPost')->name('image.upload.post');
Auth::routes();



Route::group(['middleware' =>['web','auth']], function() {
    Route::get('/', function(){
        return redirect('/home');
    });

    Route::get('/news', function (){
        if(Auth::user()->admin == 0) {
          $news = \App\News::orderBy('created_at', 'desc')->paginate(5);
          $category = \App\News::distinct()->get(['category']);
          return view('news', compact('news'),compact('category') );
        }else{
            $news = \App\News::orderBy('created_at', 'desc')->paginate(5);
            $category = \App\News::distinct()->get(['category']);
            return view('adminNews', compact('news'), compact('category'));
        }
        $news = \App\News::paginate(5);
        return view('news', compact('news'));
    });

    Route::get('/home', function () {
        if(Auth::user()->admin == 0){
            return view('/home');
        }else{
            $users = \App\User::all();
            return view('/admin', compact('users'));
        }

    });
});
