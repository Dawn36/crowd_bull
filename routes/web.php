<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PlatFormController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\TableController;
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
Route::get('scrap_data', [DashboardController::class, 'scrapData'])->name('scrap_data');
Route::middleware(['auth'])->group(function () {
    Route::get('crowdestate', [TableController::class, 'crowdestate'])->name('crowdestate');
    Route::get('estateguru', [TableController::class, 'estateguru'])->name('estateguru');
    Route::get('housers', [TableController::class, 'housers'])->name('housers');
    Route::get('nordstreet', [TableController::class, 'nordstreet'])->name('nordstreet');
    Route::get('profitus', [TableController::class, 'profitus'])->name('profitus');
    Route::get('rendity', [TableController::class, 'rendity'])->name('rendity');



Route::resource('blogs', BlogController::class);

Route::resource('projects', ProjectController::class);

Route::resource('plat_form', PlatFormController::class);
// Route::resource('user', UserController::class);


Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('settings', SettingsController::class);
Route::post('/settings/{id}/updateEmail', [SettingsController::class, 'updateEmail'])->name('updateEmail');
Route::post('/settings/{id}/updatePassword', [SettingsController::class, 'updatePassword'])->name('updatePassword');
});

Route::get('/', [WebsiteController::class, 'home'])->name('index');
Route::get('crowdfunding-platform', [WebsiteController::class, 'platForm'])->name('crowdfunding-platform');
Route::get('crowdfunding-platforms/{platFormName}', [WebsiteController::class, 'platFormDetails'])->name('crowdfunding-platforms');
Route::get('crowdfunding-projects', [WebsiteController::class, 'project'])->name('crowdfunding-projects');
Route::get('articles', [WebsiteController::class, 'articles'])->name('articles');
Route::get('article-single/{id}', [WebsiteController::class, 'articleDetails'])->name('article-single');
Route::get('about-us', [WebsiteController::class, 'aboutUs'])->name('about-us');
Route::get('privacy-policy', [WebsiteController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('ad-policy', [WebsiteController::class, 'adPolicy'])->name('ad-policy');


// Route::get('/', function () {
//     return redirect('login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
