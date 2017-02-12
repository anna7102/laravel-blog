<?php

use \Illuminate\Validation\Factory as Validator;
use \Illuminate\Http\Request as Request;

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
   return redirect()->route('blog.index');
});

Route::get('/home',
    [ 'uses' =>'PostController@getIndex',
        'as' => 'blog.index'
    ]);

Route::get('post/{id}',
    [ 'uses' =>'PostController@getPost',
    'as' => 'blog.post'
    ]);

Route::get('post/{id}/like',
    [ 'uses' =>'PostController@getLikePost',
        'as' => 'blog.post.like'
    ]);

Route::get('/categories', function () {
    return view('blog.categories');
})->name('blog.categories');;

Route::get('/contact', function () {
    return view('others.contact');
})->name('others.contact');

Route::post('/contact', function (Request $request, Validator $validator) {
    $validation = $validator->make($request->all(), [
        'name' => 'required|min:5',
        'email' => 'required|email',
        'message' => 'required|min:10'
    ]);
    if($validation->fails())
    {
        return redirect()->back()->withErrors($validation);
    }
    return redirect()
        ->route('others.contact')
        ->with('info', 'Votre message a bien été envoyé, merci. Message: ' . $request->input('message'));
})->name('others.contact');

Route::group(['prefix' => 'admin'], function(){
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create',  [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create',  [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}',  [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}',  [
        'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit',  [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);

});



