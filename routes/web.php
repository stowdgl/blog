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

Route::get('/', "BlogController@index")->name('home-page');


Route::get('/post/{id}', "BlogController@showPost")->where('id',"[0-9]+");


Route::get('/about', "BlogController@about")->name('about');


Route::get('/contact', "BlogController@contact")->name('contact');


Route::get('/categories', "BlogController@showCategories")->name('categories');


Route::get('/category/{id}', "BlogController@showCategory")->name('category');


Route::get('/posts', "BlogController@showPosts")->name('all-posts');


Route::get('/tags/{tag}', "BlogController@showPostsWithTags")->name('tags-show');


Route::get('/error-occured',function (){
    Log::error('Error occured. Reason - unknown');
   return redirect('/');
});

Route::post('/logout','UserController@logout')->name('logout');
Route::get('/logout','UserController@logout')->name('logout');
Auth::routes();
Route::post('/register/store', 'RegistrationController@register')->name('register-user');
Route::post('/addcomment','BlogController@addComment')->name('add-comment');



Route::group(['middleware' => 'App\Http\Middleware\AdminPanel'], function(){
    Route::get('/admin', '\App\Http\Controllers\Admin\AdminController@index')->name('admin-index');

    Route::get('/admin/add-post','\App\Http\Controllers\Admin\AdminController@addPostForm')->name('admin-add-post-form');

    Route::post('/admin/add-post', '\App\Http\Controllers\Admin\AdminController@add_post')->name('admin-add-post');

    Route::post('/admin/request/action', '\App\Http\Controllers\Admin\AdminController@requestAction')->name('admin-request-action');

    Route::get('/admin/add-category', '\App\Http\Controllers\Admin\AdminController@addCategoryForm')->name('admin-add-category-form');
    Route::post('/admin/add-category', '\App\Http\Controllers\Admin\AdminController@add_category')->name('admin-add-category');

    Route::get('/admin/db-backup','\App\Http\Controllers\Admin\AdminController@dbBackup')->name('admin-db-backup');
    Route::get('/admin/requests', '\App\Http\Controllers\Admin\AdminController@requestTable')->name('admin-request-table');
    Route::get('/admin/comments', '\App\Http\Controllers\Admin\AdminController@commentTable')->name('admin-comment-table');
});
