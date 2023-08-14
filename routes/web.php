<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return view('guest.test');
});
Route::post('/test', [App\Http\Controllers\Guest\MainController::class, 'test'])->name('test');

Route::get('/', [App\Http\Controllers\Guest\MainController::class, 'index'])->name('home');
Route::get('/about-us', [App\Http\Controllers\Guest\MainController::class, 'about'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\Guest\MainController::class, 'contact'])->name('contact');
Route::post('/contact-us', [App\Http\Controllers\Guest\MainController::class, 'contactSend'])->name('contact.send');
Route::get('/our-management', [App\Http\Controllers\Guest\MainController::class, 'management'])->name('management');
Route::get('/gallery', [App\Http\Controllers\Guest\MainController::class, 'gallery'])->name('gallery');
Route::get('/gallery-show/{gallery}', [App\Http\Controllers\Guest\MainController::class, 'galleryShow'])->name('gallery.show');
Route::get('/apply-now', [App\Http\Controllers\Guest\MainController::class, 'apply'])->name('apply');
// blog
Route::get('/news-events', [App\Http\Controllers\Guest\Post\BlogController::class, 'index'])->name('blog.index');
Route::get('/news-events/{post}', [App\Http\Controllers\Guest\Post\BlogController::class, 'show'])->name('blog.show')->middleware('track.views');
// category
Route::get('/news-events/category', [App\Http\Controllers\Guest\Post\CategoryController::class, 'index'])->name('category.index');
Route::get('/news-events/category/{category}', [App\Http\Controllers\Guest\Post\CategoryController::class, 'show'])->name('category.show');
Route::get('/testimony', [App\Http\Controllers\Guest\MainController::class, 'createTestimony'])->name('testimony.create');
Route::post('/testimony', [App\Http\Controllers\Guest\MainController::class, 'storeTestimony'])->name('testimony.store');

Route::post('/subscribe', [App\Http\Controllers\Guest\MainController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe', [App\Http\Controllers\Guest\MainController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/unsubscribe', [App\Http\Controllers\Guest\MainController::class, 'unsubscribe'])->name('unsubscribe.user');

Route::get('/download/application-form', [App\Http\Controllers\Guest\MainController::class, 'downloadApplicationForm'])->name('download.app.form');

Route::get('/sitemap.xml', [App\Http\Controllers\Guest\Sitemap\SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap/posts.xml', [App\Http\Controllers\Guest\Sitemap\PostSitemapController::class, 'index'])->name('sitemap.posts.index');
Route::get('/sitemap/posts/{letter}.xml', [App\Http\Controllers\Guest\Sitemap\PostSitemapController::class, 'show'])->name('sitemap.posts.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session') ,'verified', 'activeuser'])->group(function () {

    // ADMIN ROUTE
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [App\Http\Controllers\Admin\MainController::class, 'index'])->name('home');

        Route::get('/wesbite/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.home');
        Route::put('/settings/{setting}', 'App\Http\Controllers\Admin\SettingsController@update')->name('settings.update');

        // roles
        Route::resource('roles', 'App\Http\Controllers\Admin\RoleController');

        // post
        Route::resource('posts', 'App\Http\Controllers\Admin\BlogController');
        Route::get('/posts/category/{category}', 'App\Http\Controllers\Admin\BlogController@showPostsByCategory')->name('posts.category.show');
        Route::get('/posts/author/{user}', 'App\Http\Controllers\Admin\BlogController@showPostsByUser')->name('posts.user.show');
        Route::get('{draft}/posts', 'App\Http\Controllers\Admin\BlogController@index')->name('draft.posts');
        Route::get('{pending}/posts', 'App\Http\Controllers\Admin\BlogController@index')->name('pending.posts');
        Route::get('/posts/{post}/publish', 'App\Http\Controllers\Admin\BlogController@publishPost')->name('posts.publish');
        Route::get('/posts/{post}/undraft', 'App\Http\Controllers\Admin\BlogController@undraftPost')->name('posts.undraft');
        Route::get('/posts/{post}/analytics', 'App\Http\Controllers\Admin\BlogController@showAnalytics')->name('analytics.posts');
        Route::get('/posts-comments/{post}', 'App\Http\Controllers\Admin\BlogController@showComments')->name('posts.comments');
        Route::get('/delete/posts-comments/{post}', 'App\Http\Controllers\Admin\BlogController@deleteComments')->name('posts.comments.delete');
        // trash posts
        Route::get('{trash}/posts', 'App\Http\Controllers\Admin\BlogController@index')->name('posts.trash');
        Route::delete('/trash-posts/{post}', 'App\Http\Controllers\Admin\BlogController@destory')->name('posts.trashPost');
        Route::delete('/trash-posts/force-delete/{post}', 'App\Http\Controllers\Admin\BlogController@forceDestroy')->name('posts.forceDestroy');
        Route::get('/trash-posts/restore/{post}', 'App\Http\Controllers\Admin\BlogController@restore')->name('posts.restore');

        // category
        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');

        // management
        Route::resource('managements', 'App\Http\Controllers\Admin\ManagementController');

        // subscribe
        Route::resource('subscribes', 'App\Http\Controllers\Admin\SubscribeController');

        // users
        Route::get('users/{user}', 'App\Http\Controllers\Admin\UsersController@index')->name('users.index');
        Route::get('users/create/{user}', 'App\Http\Controllers\Admin\UsersController@create')->name('users.create');
        Route::post('users/admin/create', 'App\Http\Controllers\Admin\UsersController@store')->name('users.admin.store');
        Route::get('users/{type}/{user}/edit', 'App\Http\Controllers\Admin\UsersController@edit')->name('users.edit');
        Route::get('users/{type}/{user}/', 'App\Http\Controllers\Admin\UsersController@show')->name('users.show');

        // trash users
        Route::get('blocked-{type}/', 'App\Http\Controllers\Admin\UsersController@indexTrash')->name('users.trash');
        Route::delete('blocked-{type}/block/{user}', 'App\Http\Controllers\Admin\UsersController@blockUser')->name('users.blockUser');
        Route::delete('blocked-{type}/force-delete/{user}', 'App\Http\Controllers\Admin\UsersController@forceDestroy')->name('users.forceDestroy');
        Route::get('blocked-{type}/restore/{user}', 'App\Http\Controllers\Admin\UsersController@restore')->name('users.restore');


        // gallery
        Route::resource('galleries', 'App\Http\Controllers\Admin\GalleryController');
        Route::get('galleries/add-photos/{gallery}', 'App\Http\Controllers\Admin\GalleryController@addPhotos')->name('galleries.add.photos');

        // mail
        Route::get('mail', 'App\Http\Controllers\Admin\MailController@index')->name('mail.index');
        Route::get('sent-mail/{mail}', 'App\Http\Controllers\Admin\MailController@show')->name('mail.show');
        Route::get('mail/compose', 'App\Http\Controllers\Admin\MailController@compose')->name('mail.send');

        // testimonies
        Route::resource('testimonies', 'App\Http\Controllers\Admin\TestimonyController');

        Route::get('/profile', 'App\Http\Controllers\Admin\ProfileController@index')->name('profile');
        Route::put('/profile', 'App\Http\Controllers\Admin\ProfileController@updateProfile')->name('profile.update');
        Route::put('/update-password', 'App\Http\Controllers\Admin\ProfileController@updatePassword')->name('profile.update.password');

        Route::get('/notifications', 'App\Http\Controllers\Admin\MainController@notifications')->name('notifications');
    });

    // CONTENT WRITER ROUTE
    Route::group(['middleware' => 'writer', 'prefix' => 'author', 'as' => 'writer.'], function () {
        Route::get('/', [App\Http\Controllers\Writer\MainController::class, 'index'])->name('home');
        // posts
        Route::resource('posts', 'App\Http\Controllers\Writer\BlogController');
        Route::get('/posts/category/{category}', 'App\Http\Controllers\Writer\BlogController@showPostsByCategory')->name('posts.category.show');
        Route::get('{draft}/posts', 'App\Http\Controllers\Writer\BlogController@index')->name('draft.posts');
        Route::get('/posts/author/{user}', 'App\Http\Controllers\Writer\BlogController@showPostsByUser')->name('posts.user.show');
        Route::get('{pending}/posts', 'App\Http\Controllers\Writer\BlogController@index')->name('pending.posts');
        Route::get('/posts/{post}/publish', 'App\Http\Controllers\Writer\BlogController@publishPost')->name('posts.publish');
        Route::get('/posts/{post}/undraft', 'App\Http\Controllers\Writer\BlogController@undraftPost')->name('posts.undraft');
        Route::get('/posts/{post}/analytics', 'App\Http\Controllers\Writer\BlogController@showAnalytics')->name('analytics.posts');
        Route::get('/posts-comments/{post}', 'App\Http\Controllers\Writer\BlogController@showComments')->name('posts.comments');

        // trash posts
        Route::get('{trash}/posts', 'App\Http\Controllers\Writer\BlogController@index')->name('posts.trash');
        Route::delete('/trash-posts/{post}', 'App\Http\Controllers\Writer\BlogController@destory')->name('posts.trashPost');
        Route::delete('/trash-posts/force-delete/{post}', 'App\Http\Controllers\Writer\BlogController@forceDestroy')->name('posts.forceDestroy');
        Route::get('/trash-posts/restore/{post}', 'App\Http\Controllers\Writer\BlogController@restore')->name('posts.restore');
        Route::get('/posts-comments/{post}', 'App\Http\Controllers\Writer\BlogController@showComments')->name('posts.comments');

        // gallery
        Route::resource('galleries', 'App\Http\Controllers\Writer\GalleryController');
        // Route::resource('galleries', 'App\Http\Controllers\Admin\GalleryController');

        Route::get('/profile', 'App\Http\Controllers\Writer\ProfileController@index')->name('profile');
        Route::put('/profile', 'App\Http\Controllers\Writer\ProfileController@updateProfile')->name('profile.update');
        Route::put('/update-password', 'App\Http\Controllers\Writer\ProfileController@updatePassword')->name('profile.update.password');

        Route::get('/notifications', 'App\Http\Controllers\Writer\MainController@notifications')->name('notifications');

    });

    Route::post('/mark-as-read', 'App\Http\Controllers\Writer\MainController@markNotification')->name('markNotification');

});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //     Route::get('/admin',[App\Http\Controllers\Admin\MainController::class, 'index'])->name('home');
    // });


// });
