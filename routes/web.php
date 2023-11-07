<?php

use Illuminate\Support\Facades\Route;

//Namespace Auth
use App\Http\Controllers\Auth\LoginController;

//Namespace Admin
use App\Http\Controllers\Admin\AdminController;

//Namespace User
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Admin\DashboardAdmin;
use App\Http\Livewire\Admin\CreateMahasiswa;
use App\Http\Livewire\Admin\ManajemenMahasiswa;

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

Route::view('/','welcome');


Route::group(['namespace' => 'Admin','middleware' => 'auth','prefix' => 'admin'],function(){

	// Route::get('/',[AdminController::class,'index'])->name('admin')->middleware(['can:admin']);
	Route::get('/',[DashboardAdmin::class,'render'])->name('admin')->middleware(['can:admin']);
	// Route::get('/',DashboardAdmin::class)->name('admin');

	Route::resource('/user','UserController')->middleware(['can:admin']);

	// Route::get('/user',[CreateMahasiswa::class,'render'])->name('admin')->middleware(['can:admin']);
	// Route::get('/user',[ManajemenMahasiswa::class,'render'])->name('manajemen-user')->middleware(['can:admin']);
	Route::get('/create-mahasiswa',[CreateMahasiswa::class,'render'])->name('create-mahasiswa')->middleware(['can:admin']);


	//Route Rescource
	// Route::resource('/user','UserController')->middleware(['can:admin']);

	//Route View

	Route::view('/404-page','admin.404-page')->name('404-page');
	Route::view('/blank-page','admin.blank-page')->name('blank-page');
	Route::view('/buttons','admin.buttons')->name('buttons');
	Route::view('/cards','admin.cards')->name('cards');
	Route::view('/utilities-colors','admin.utilities-color')->name('utilities-colors');
	Route::view('/utilities-borders','admin.utilities-border')->name('utilities-borders');
	Route::view('/utilities-animations','admin.utilities-animation')->name('utilities-animations');
	Route::view('/utilities-other','admin.utilities-other')->name('utilities-other');
	Route::view('/chart','admin.chart')->name('chart');
	Route::view('/tables','admin.tables')->name('tables');


});

Route::group(['namespace' => 'User','middleware' => 'auth' ,'prefix' => 'user'],function(){
	Route::get('/',[UserController::class,'index'])->name('user');
	Route::get('/profile',[ProfileController::class,'index'])->name('profile');
	Route::get('/irs',[UserController::class,'irs'])->name('irs');
	Route::post('/irs',[UserController::class,'storeIrs'])->name('irs.store');
	Route::post('/khs',[UserController::class,'storeKhs'])->name('khs.store');
	Route::get('/khs',[UserController::class,'khs'])->name('khs');
	Route::post('/pkl',[UserController::class,'storePkl'])->name('pkl.store');
	Route::get('/pkl',[UserController::class,'pkl'])->name('pkl');
	Route::post('/skripsi',[UserController::class,'storeSkripsi'])->name('skripsi.store');
	Route::get('/skripsi',[UserController::class,'skripsi'])->name('skripsi');
	Route::patch('/profile/update/{user}',[ProfileController::class,'update'])->name('profile.update');
	Route::post('/profile/initialUpdate/{user}',[ProfileController::class,'updateInitialData'])->name('profile.updateInitialData');
});

Route::group(['namespace' => 'Auth','middleware' => 'guest'],function(){
	Route::view('/login','auth.login')->name('login');
	Route::post('/login',[LoginController::class,'authenticate'])->name('login.post');
});

// Other
Route::view('/register','auth.register')->name('register');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');
Route::post('/logout',function(){
	return redirect()->to('/login')->with(Auth::logout());
})->name('logout');
