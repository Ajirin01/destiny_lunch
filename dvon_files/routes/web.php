<?php
use Illuminate\Http\Request;
use App\country as Country;

Route::get('/', 'HomeController@index');

//discover nigeria
Route::get('/discover-nigeria', 'DiscoverNigeriaController@index');

//registering next page
Route::get('/register-next', function(Request $request){
    Session::put('fullname', $request->fullname);
    Session::put('country', $request->country_name);
    Session::put('phone', $request->phone);
    return view('auth.register-next');
})->name('next');

//place advert routes
Route::get('/place-your-adverts', 'site\TopLeftLinksController@place_advert')->middleware('auth');

//blog posts routes
Route::prefix('blog')->group(function(){
    // Route::get('posts',	'Blog\postsController@allPosts')->name('posts');
    Route::get('/create', 'Blog\blogController@create_blog_form');
    Route::post('/create', 'Blog\blogController@create_blog');
    Route::get('/{user_name}/{blog_name}', 'Blog\postsController@allPosts')->name('posts');
    Route::get('/{user_name}/{blog_name}/{post}', 'Blog\postsController@onePost')->name('post_details');
    // Route::get('post/{post}', 'Blog\postsController@onePost')->name('post_details');
    Route::post('/{user_name}/{blog_name}/{post}/comment',	'Blog\postsController@sendOnePostComment')->name('post_comment')->middleware('auth');
}); 

//auth routes
Auth::routes(['verify' => true]);

//admin routes
Route::prefix('admin')->group(function(){
        Route::get('dashboard', 'Admin\dashboardController@dashboard')->middleware('admin');
        Route::get('calender', 'Admin\calendarController@showCalender')->middleware('admin');
        Route::get('comments', 'Admin\UserActionToArticle@comments_index')->middleware('admin');
        Route::post('delete-comment/{comment_id}', 'Admin\UserActionToArticle@delete_comment')->middleware('admin');
        Route::post('update-comment_status/{comment_id}', 'Admin\UserActionToArticle@update_comment_status')->middleware('admin');
        Route::resource('adverts', 'Admin\advertsController')->middleware('admin');
        Route::get('newsletters', 'Admin\newsletterController@index')->middleware('admin');
        Route::delete('newsletters/delete-newsletter/{id}', 'Admin\newsletterController@destroy')->middleware('admin');
        Route::get('newsletters/send-newsletters/form', 'Admin\newsletterController@sendNewslettersForm')->middleware('admin');
        Route::post('newsletters/send-newsletters', 'Admin\newsletterController@sendNewsletters')->middleware('admin');
        Route::resource('users', 'Admin\usersController')->middleware('admin')->middleware('admin');
        // Route::resource('country', 'Admin\countriesController');
        Route::resource('external-links', 'Admin\linksController')->middleware('admin');
        // Route::resource('blog', 'Admin\blogController')->middleware('admin');
        Route::resource('blog-post', 'Admin\blogPostController')->middleware('admin');
        Route::resource('article', 'Admin\articleController')->middleware('admin');
        Route::resource('profile', 'Admin\profileController')->middleware('admin');
}); 

//home route
Route::get('/home', function () {
    return redirect('/');
})->name('home');

//about route
Route::get('/about', function () {
    return view('site.about',['title'=> 'ABOUT US']);
})->name('about');

//articles routes
Route::prefix('articles')->group(function () {
    Route::get('/{type}',	'site\ArticlesController@index')->name('articles-list');
    Route::get('/{type}/{article}',	'site\ArticlesController@details')->name('articles-details'); 
    Route::post('/{type}/{article}/comment', 'site\ArticlesController@postComment')->middleware('auth');
}); 

// contact us routes
Route::get('contact', 'Contact\contactController@show')->name('contactUs');
Route::post('contact', 'Contact\contactController@send')->name('contactUs');

// newletter subscriptions managemant routes
Route::post('subscribe-newsletter', 'site\NewsLetterController@subscribe');
Route::get('unsubscribe-newsletter/{email}', 'site\NewsLetterController@unsubscribe');
Route::post('unsubscribe-newsletter-done', 'site\NewsLetterController@unsubscribeDone');

// payments route for article
Route::post('/paymentplans/create', 'RaveController@createPaymentPlan')->name('createpaymentplan');
Route::post('/pay', 'RaveController@initialize')->name('pay');
Route::get('/rave/callback', 'RaveController@callback')->name('callback');
Route::get('/updatepaymentplans/{id}/{name}', 'RaveController@fetchPaymentPlan')->name('fetchPaymentPlan');

// payments route for advert
Route::post('/advert/paymentplans/create', 'AdvertRaveController@createPaymentPlan')->name('advertcreatepaymentplan');
Route::post('/advert/pay', 'AdvertRaveController@initialize')->name('advertpay');
Route::get('/advert/rave/callback', 'AdvertRaveController@callback')->name('advertcallback');
Route::get('/updateadvertpaymentplans/{id}/{name}', 'AdvertRaveController@fetchPaymentPlan')->name('fetchPaymentPlan');

Route::get('/test-flutter', function(){
    return view('site.test_flutter');
});