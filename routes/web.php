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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| APPLICATION SUMMARY ROUTES
|--------------------------------------------------------------------------
|
*/
Route::get('/about',['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('/terms',['as' => 'terms', 'uses' => 'HomeController@terms']);
Route::get('/contact',['as' => 'contact', 'uses' => 'HomeController@contact']);

Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@index']);

Route::get('/write',['as' => 'write', 'uses' => 'SubmissionController@writeForUs', 'middleware' => 'auth']);

Route::get('/submissions','SubmissionController@index');

Route::post('/write', 
  ['as' => 'storeSubmission', 'uses' => 'SubmissionController@storeSubmission', 'middleware' => 'auth']);

  // delete submissions
 Route::get('submission/delete/{id}',['as' => 'submission/delete', 'uses' => 'SubmissionController@deleteSubmission', 'middleware' => 'auth']);

//Search Results Route
Route::get('/search',['as' => 'search', 'uses' => 'SearchController@index']);


//edit User Bio
Route::post('/edit-bio', [
		'uses' => 'UserController@editBio',
		'as' => 'edit-bio',
		'middleware' => 'auth'
	]);
//users profile
Route::get('user/{id}',['as' => 'profile', 'uses' => 'UserController@profile', 'middleware' => 'auth'])->where('id', '[0-9]+');

//USER PROFILE PICTURE ROUTES
Route::get('avatar',['as' => 'avatar', 'uses' => 'UserController@avatar', 'middleware' => 'auth']);

Route::post('avatar',['as' => 'avatar', 'uses' => 'UserController@update_avatar', 'middleware' => 'auth']);

//USER COVER PICTURE ROUTES
Route::get('cover',['as' => 'cover', 'uses' => 'UserController@cover', 'middleware' => 'auth']);

Route::post('cover',['as' => 'cover', 'uses' => 'UserController@update_cover', 'middleware' => 'auth']);

Route::get('/tasks', ['as'=>'tasks', 'uses'=> 'TaskController@index', 'middleware' => 'auth']);

Route::post('/task', ['as'=>'store-task', 'uses'=> 'TaskController@store', 'middleware' => 'auth']);

Route::delete('/task/{task}', ['as'=>'delete-task', 'uses'=> 'TaskController@destroy', 'middleware' => 'auth']);
/*
|--------------------------------------------------------------------------
| BOOK SUMMARY ROUTES
|--------------------------------------------------------------------------
|
*/
Route::get('/books','BookController@index');
Route::get('/books',['as' => 'books', 'uses' => 'BookController@index']);
// show new summary form
 Route::get('new-book',['as' => 'new-book', 'uses' => 'BookController@create', 'middleware' => 'auth']);
 // save new book
 Route::post('new-book',['as' => 'new-book', 'uses' => 'BookController@store', 'middleware' => 'auth']);
 // edit book form
 Route::get('edit-book/{slug}',['as' => 'edit-book/{slug}', 'uses' => 'BookController@edit', 'middleware' => 'auth']);
 // update book
 Route::post('update-book',['as' => 'update-book', 'uses' => 'BookController@update', 'middleware' => 'auth']);
 // delete book
 Route::get('delete-book/{id}',['as' => 'delete-book/{id}', 'uses' => 'BookController@destroy', 'middleware' => 'auth']);
 // display user's all books
 Route::get('my-all-books',['as' => 'my-all-books', 'uses' => 'UserController@user_books_all', 'middleware' => 'auth']);
 // display user's drafts of books
 Route::get('my-book-drafts',['as' => 'my-book-drafts', 'uses' => 'UserController@user_books_draft', 'middleware' => 'auth']);
 // add comment
 Route::post('comment-book/add',['as' => 'comment-book/add', 'uses' => 'BookCommentController@store', 'middleware' => 'auth']);
  // delete comment on book post
 Route::get('book_comment/delete/{id}',['as' => 'book_comment/delete', 'uses' => 'BookCommentController@getDeleteComment', 'middleware' => 'auth']);

 //edit User comments
Route::post('/edit-book-comment', [
		'uses' => 'BookCommentController@editComment',
		'as' => 'edit-book-comment'
	]);

 // display list of books
Route::get('user-book/{id}/books',['as' => 'my-all-books', 'uses' => 'UserController@user_books', 'middleware' => 'auth'])->where('id', '[0-9]+');

//like
Route::post('/like',['as' => 'like', 'uses' => 'BookController@likeBook']);

// display single book
Route::get('book/{slug}',['as' => 'book', 'uses' => 'BookController@show'])->where('slug', '[A-Za-z0-9-_]+');


/*
|--------------------------------------------------------------------------
| BLOG ROUTES
|--------------------------------------------------------------------------
|
*/
Route::get('/blog','PostController@index');
Route::get('/blog',['as' => 'blog', 'uses' => 'PostController@index']);
 // show new post form
 Route::get('new-post',['as' => 'new-post', 'uses' => 'PostController@create', 'middleware' => 'auth']);
 // save new post
 Route::post('new-post',['as' => 'new-post', 'uses' => 'PostController@store', 'middleware' => 'auth']);
 // edit post form
 Route::get('edit/{slug}',['as' => 'edit/{slug}', 'uses' => 'PostController@edit', 'middleware' => 'auth']);
 // update post
 Route::post('update',['as' => 'update', 'uses' => 'PostController@update', 'middleware' => 'auth']);
 // delete post
 Route::get('delete/{id}',['as' => 'delete/{id}', 'uses' => 'PostController@destroy', 'middleware' => 'auth']);
 // display user's all posts
 Route::get('my-all-posts',['as' => 'my-all-posts', 'uses' => 'UserController@user_posts_all', 'middleware' => 'auth']);
 // display user's drafts
 Route::get('my-drafts',['as' => 'my-drafts', 'uses' => 'UserController@user_posts_draft', 'middleware' => 'auth']);
 // add comment
 Route::post('comment/add',['as' => 'comment/add', 'uses' => 'CommentController@store', 'middleware' => 'auth']);
 // delete comment
 Route::get('comment/delete/{id}',['as' => 'comment/delete', 'uses' => 'CommentController@getDeleteComment', 'middleware' => 'auth']);

//edit User comments
Route::post('/edit-comment', [
		'uses' => 'CommentController@editComment',
		'as' => 'edit-comment',
		'middleware' => 'auth'
	]);
// display list of posts
Route::get('user/{id}/posts',['as' => 'user/{id}/posts', 'uses' => 'UserController@user_posts', 'middleware' => 'auth'])->where('id', '[0-9]+');
// display single post
Route::get('/{slug}','CommentController@index');
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');

