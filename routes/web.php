<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TryController;
use App\Http\Controllers\ShowProfileController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoCommentController;
use App\Http\Controllers\PostController;


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

Route::get('blade', function () {
    return view('child');
});

/*
Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);
*/
Route::get('photos/popular', [PhotoController::class, 'popular']);
Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
    ]);
# Route::apiResource('photos', PhotoController::class); # <-- will not have create and edit actions.
Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);

Route::resource('photos.comments', PhotoCommentController::class)
#->scoped([ 'comment' => 'slug', ]);
#->shallow(); # we will have comments/{comment}....
->names([ 'create' => 'photos.build' ]);

# /test_single_act_ctrl/9
Route::get('/test_single_act_ctrl/{id}', ShowProfileController::class);

Route::redirect('/bar', '/foo');
#Route::redirect('/bar', '/foo', 301);
#Route::permanentRedirect('/here', '/there');
Route::get('foo', function () {
    return 'Hello World';
});

Route::get('/user', [UserController::class, 'index']);

Route::view('/welcome', 'welcome');

Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return $postId . ',' . $commentId;
});

Route::get('user/{name?}', function ($name = null) {
    return $name;
});
Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});

Route::resource('users0', AdminUserController::class)->parameters([
    'users0' => 'admin_user'
]);

Route::resource('users.posts', PostController::class)->scoped(); # generating users/{user}/posts... & users/{user}/posts/{post}...

/*
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);

Route::match(['get', 'post'], '/', function () {
    //
});

Route::any('/', function () {
    //
});
*/

Route::get('user/{name}', function ($name) {
    return 'name' . $name;
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
    return 'id' . $id;
})->where('id', '[0-9]+');

/*Route::get('user/{id}/{name}', function ($id, $name) {
    return [$id, $name];
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);*/

$before = App\Http\Middleware\BeforeMiddleware::class;
$after = App\Http\Middleware\AfterMiddleware::class;
Route::get('test_RouteServiceProvider/{id}', function ($id) {
    return $id;
})
->middleware('grp1'); #->middleware([$before, $after]);

Route::get('search/{search}', function ($search) {
    return $search;
})->where('search', '.*');

# Named Routes
/*Route::get('user/{id}/profile', function ($id) {
    return 'user/{id}/profile---' . $id;
})->name('profile');
*/
Route::get('user/{id}/profile', [UserProfileController::class, 'show'])->name('profile');

Route::get('/try/try1', [TryController::class, 'try1']);

# Implicit Binding
Route::get('api/users/{user}', function (App\Models\User $user) {
    return $user->email;
});
# Customizing The Key
Route::get('api/posts/{post:slug}', function (App\Models\Post $post) {
    return $post;
});


/*
use App\Http\Middleware\CheckAge;

Route::middleware([CheckAge::class])->group(function () {
    Route::get('/', function () {
        //
    });

    Route::get('admin/profile', function () {
        //
    })->withoutMiddleware([CheckAge::class]);
});*/
