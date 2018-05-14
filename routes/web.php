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
// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/',function(){
//     return view('auth.register');
// });
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category/{id}','HomeController@category');
Route::get('/', 'PagesController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/category/add', 'CategoryController@add');
Route::get('/dashboard/category/list', 'CategoryController@list');
Route::get('/dashboard/category/delete/{id}', 'CategoryController@delete');
Route::post('/dashboard/category/added', 'CategoryController@store')->name('addcategory');
Route::post('/dashboard/category/update','CategoryController@update')->name('updatecategory');
Route::get('/dashboard/category/edit/{id}','CategoryController@edit');
Route::resource('posts', 'PostsController');
Route::get('/like/{id}','PostsController@like');
Route::post('/comment/{id}','PostsController@comment');
Route::get('/profile','ProfileController@profile');
Route::post('/addProfile','ProfileController@addProfile');
Route::get('/dashboards','DashboardsController@dashboard');
?>
