<?php

use Illuminate\Support\Facades\Route;


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


// Route::get('students', 'ApiController@getAllStudents');
// Route::get('students/{id}', 'ApiController@getStudent');
// Route::post('students', 'ApiController@createStudent');
// Route::put('students/{id}', 'ApiController@updateStudent');
// Route::delete('students/{id}','ApiController@deleteStudent');


// Route::get('/post/asd/asd/wqe/asd/asd/asd/asd', array( 'as' => 'admin.kur', function () {

//     $url = route('admin.kur');

//     return 'this urls is'. $url;
// }));


// Route::get('/post/{id}', 'App\Http\Controllers\PostsController@index', );
// Route::resource('posts', 'App\Http\Controllers\PostsController');

// Route::get('contact', 'App\Http\Controllers\PostsController@contact');

// Route::get('post/{id}/{years}/{name}', 'App\Http\Controllers\PostsController@show_post');








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
