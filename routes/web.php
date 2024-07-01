<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use GuzzleHttp\Psr7\UploadedFile;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'verify' => True
]);

Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboardadmin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboardadmin', [AdminController::class, 'viewReports'])->name('admin.reports');

    Route::delete('/admin/dashboardadminfiles/{id}', [AdminController::class, 'deleteFile'])->name('admin.deleteFile');

    Route::delete('/admin/dashboardadmin/{id}', [AdminController::class, 'deleteReport'])->name('admin.deleteReport');

    Route::post('/admin/dashboardadmin/{id}', [AdminController::class, 'approveReport'])->name('admin.approveReport');

    Route::get('/admin/dashboardadminfiles', [AdminController::class, 'viewFiles'])->name('admin.viewFiles');

    Route::get('/admin/dashboardadminaccount', [AdminController::class, 'viewUsers'])->name('admin.viewUsers');

    Route::delete('/admin/dashboardadminaccount/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::get('/admin/dashboardaddminplusadmin', [AdminController::class, 'addAccount'])->name('admin.register');

    Route::post('/admin/dashboardaddminplusadmin', [AdminController::class, 'register'])->name('admin.register.submit');

});

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/Upload', [UploadController::class, 'Upload'])->name('Upload');

Route::get('/Upload', [HomeController::class, 'Upload'])->name('UploadPage')->middleware('verified');

Route::get('/profile', [UploadController::class, 'viewData'])->name('viewData');

Route::get('/edit/{id}', [UploadController::class, 'Edit'])->name('editFile');

Route::patch('/updateFile/{id}', [UploadController::class, 'Update'])->name('updateFile');

Route::delete('/dashboard/{id}', [UploadController::class, 'delete'])->name('delete');

Route::get('/view-file/{fileName}', [UploadController::class, 'viewFile'])->name('viewFile');

Route::get('/Profile', [HomeController::class, 'Profile'])->name('Profile');

Route::get('/editProfile', [HomeController::class, 'editProfile'])->name('editProfile');

Route::patch('/profile', [HomeController::class, 'updateProfile'])->name('updateProfile')->middleware('verified');

Route::get('/Dashboard', [HomeController::class, 'Dashboard'])->name('Dashboard')->middleware('verified');

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

Route::post('/file/unlike/{file}', [UploadController::class, 'unlikeFile'])->name('unlikeFile');

Route::post('/report/{file}', [UploadController::class, 'reportFile'])->name('reportFile');

Route::get('/reports', [UploadController::class, 'viewReports'])->middleware('auth', 'admin')->name('viewReports');

Route::post('/comments/{file}', [UploadController::class, 'store'])->name('comments.store');

Route::post('/comments/{comment}/like', [UploadController::class, 'like'])->name('comments.like');

Route::post('/comments/{comment}/report', [UploadController::class, 'report'])->name('comments.report');