<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('students', 'App\Http\Controllers\ApiController@getAllStudents');
Route::get('students/{id}', 'App\Http\Controllers\ApiController@getStudent');
Route::post('students', 'App\Http\Controllers\ApiController@createStudent');
Route::put('students/{id}', 'App\Http\Controllers\ApiController@updateStudent');
Route::delete('students/{id}','App\Http\Controllers\ApiController@deleteStudent');



Route::resource('topics','App\Http\Controllers\TopicsController');

// custom search by tag name
Route::post('topics/searchtags', 'App\Http\Controllers\TopicsController@tagSearch');
// custom return news by categories
Route::post('topics/shownewsbycategory', 'App\Http\Controllers\TopicsController@showNewsByCategory');
// custom return all categories from DB and set it as JS foreach
Route::get('categories', 'App\Http\Controllers\CategoriesController@returnCategories');
// custom return single category ID by name
Route::post('categories/returncategoryid', 'App\Http\Controllers\CategoriesController@returnCategoryIdByName');

#CUSTOM USER ROUTES
// get comments for post 
// Route::get('topics/{topic_id}/comments', 'App\Http\Controllers\CommentController@index');

// Route::middleware('auth:api')->group( function(){
//     Route::post('topics/{topic_id}/comment', 'App\Http\Controllers\CommentController@store');
// });
# CUSTOM AUTH
// Route::post('/login', 'App\Http\Controllers\ApiAuthController@login')->name('login.api');
// Route::post('/register','App\Http\Controllers\ApiAuthController@register')->name('register.api');
// Route::post('/logout', 'App\Http\Controllers\ApiAuthController@logout')->name('logout.api');


Route::post('/registernew', 'App\Http\Controllers\API\AuthController@register');
Route::post('/loginnew', 'App\Http\Controllers\API\AuthController@login');

Route::get('/getuser', 'App\Http\Controllers\API\AuthController@getUser')->middleware('auth:api');

# CUSTOM comments
// get all comments of a topic
Route::get('gettopiccomments/{newsid}', 'App\Http\Controllers\CommentController@getAllCommentsOfaNews');
// post comment

Route::post('/createnewcomment', 'App\Http\Controllers\CommentController@createComment')->middleware('auth:api');

// # ADMIN
// createa topic
Route::post('/createnewtopic', 'App\Http\Controllers\TopicsController@createTopic')->middleware('auth:api');
// delete topic
Route::post('/deletetopic', 'App\Http\Controllers\TopicsController@deleteTopic')->middleware('auth:api');
// edit topic
Route::post('/edittopic', 'App\Http\Controllers\TopicsController@editTopic')->middleware('auth:api');










