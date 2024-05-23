<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use GuzzleHttp\Psr7\UploadedFile;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/Upload', [UploadController::class, 'Upload'])->name('Upload');

Route::get('/Upload', [HomeController::class, 'Upload'])->name('UploadPage');

Route::get('/profile', [UploadController::class, 'viewData'])->name('viewData');

Route::get('/edit/{id}', [UploadController::class, 'Edit'])->name('editFile');

Route::patch('/updateFile/{id}', [UploadController::class, 'Update'])->name('updateFile');

Route::delete('/dashboard/{id}', [UploadController::class, 'delete'])->name('delete');

Route::get('/view-file/{fileName}', [UploadController::class, 'viewFile'])->name('viewFile');

Route::get('/Profile', [HomeController::class, 'Profile'])->name('Profile');

Route::get('/editProfile', [HomeController::class, 'editProfile'])->name('editProfile');

Route::patch('/profile', [HomeController::class, 'updateProfile'])->name('updateProfile');

Route::get('/Dashboard', [HomeController::class, 'Dashboard'])->name('Dashboard');

Route::get('/', [UploadController::class, 'viewPublicFiles'])->name('publicFiles');

Route::get('/files/{fileName}', [UploadController::class, 'viewFile'])->name('viewFile');

Route::post('/files/{file}/like', [UploadController::class, 'likeFile'])->name('likeFile');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/AboutUs', [HomeController::class, 'About'])->name('AboutUs');

Route::get('/Popular', [HomeController::class, 'Popular'])->name('Popular');

Route::get('/LatestUpdate', [HomeController::class, 'LatestUpdate'])->name('LatestUpdate');

Route::post('/save-book/{id}', [UploadController::class, 'saveBook'])->name('saveBook');

Route::post('/remove-book/{id}', [UploadController::class, 'removeBook'])->name('removeBook');

Route::get('/saved-books', [UploadController::class, 'viewSavedBooks'])->name('viewSaved');

Route::get('/ReadBook/{id}', [HomeController::class, 'ReadBook'])->name('ReadBook');

Route::post('/follow/{id}', [HomeController::class, 'followUser'])->name('followUser');

Route::post('/unfollow/{id}', [HomeController::class, 'unfollowUser'])->name('unfollowUser');

Route::get('/followers', [HomeController::class, 'viewFollowers'])->name('viewFollowers');

Route::get('/followings', [HomeController::class, 'viewFollowings'])->name('viewFollowings');

Route::post('/follow-back/{id}', [HomeController::class, 'followBack'])->name('followBack');

Route::post('/remove-follower/{id}', [HomeController::class, 'removeFollower'])->name('removeFollower');

Route::post('/unfollow/{id}', [HomeController::class, 'unfollow'])->name('unfollow');

Route::get('/profile/{id}', [HomeController::class, 'showProfile'])->name('showProfile');

Route::get('/files/category/{category}', [UploadController::class, 'filterByCategory'])->name('filterByCategory');