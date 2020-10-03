<?php
use Illuminate\Http\Request;
use App\country as Country;

Route::get('/', 'HomeController@index');

Route::get('/register-next', function(Request $request){
    Session::put('fullname', $request->fullname);
    Session::put('country', $request->country_name);
    Session::put('phone', $request->phone);
    return view('auth.register-next');
})->name('next');

Auth::routes();

Route::get('/foo', function(){
    // Artisan::call('storage:link');
    File::link(storage_path('app/public'), public_path('storage'));
});

Route::prefix('admin')->group(function(){
        Route::get('dashboard', 'Admin\dashboardController@dashboard');
        Route::get('calender', 'Admin\calendarController@showCalender');
        Route::get('comments', 'Admin\UserActionToArticle@comments_index');
        Route::post('delete_comment/{comment_id}', 'Admin\UserActionToArticle@delete_comment');
        Route::post('update_comment_status/{comment_id}', 'Admin\UserActionToArticle@update_comment_status');
        Route::resource('adverts', 'Admin\advertsController');
        Route::resource('users', 'Admin\usersController')->middleware('admin');
        Route::resource('country', 'Admin\countriesController');
        Route::resource('external_links', 'Admin\linksController');
        Route::resource('blog', 'Admin\blogController')->middleware('admin');
        Route::resource('article', 'Admin\articleController');
        Route::resource('profile', 'Admin\profileController')->middleware('admin');
}); 

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::get('/about', function () {
    return view('site.about',['title'=> 'ABOUT US']);
})->name('home');

Route::prefix('articles')->group(function () {
    Route::get('/{type}',	'site\ArticlesController@index')->name('articles-list');
    Route::get('/{type}/{article}',	'site\ArticlesController@details')->name('articles-details'); 
}); 



