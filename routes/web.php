<?php

use Illuminate\Support\Facades\Auth;

//Namespace Auth
use Illuminate\Support\Facades\Route;

//Namespace Admin
use App\Http\Controllers\DosenController;

//Namespace User
use App\Http\Livewire\Admin\DashboardAdmin;
use App\Http\Livewire\Admin\CreateMahasiswa;
use App\Http\Controllers\User\UserController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Livewire\Admin\ManajemenMahasiswa;
use App\Http\Controllers\User\ProfileController;
use App\Http\Livewire\Departemen\DashboardDepartemen;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\DepartemenController;

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


// Route::group(['namespace' => 'Departemen','middleware' => 'auth','prefix' => 'departemen'],function(){
// 	Route::get('/',[DashboardDepartemen::class,'render'])->name('departemen')->middleware(['can:departemen']);
// 	Route::resource('/user','MahasiswaController')->middleware(['can:departemen']);
// 	// Route::get('/create-mahasiswa',[CreateMahasiswa::class,'render'])->name('create-mahasiswa')->middleware(['can:departemen']);
//     // Route::post('/user',[MahasiswaController::class,'storeMahasiswa'])->name('user.store');
//     // Route::post('/user',[MahasiswaController::class,'storeMahasiswa'])->name('user.storeMahasiswa');

//     // Route::get('/user/edit/{id}',[MahasiswaController::class,'edit'])->name('user.edit');
//     // // Route::post('/user/update/{id}',[MahasiswaController::class,'update'])->name('user.update');
//     // Route::put('/admin/user/{id}',[MahasiswaController::class,'update'])->name('user.update');
//     // Route::get('/user/reset-password/{id}',[MahasiswaController::class,'resetPassword'])->name('user.reset-password');
//     // Route::get('/user/delete/{id}',[MahasiswaController::class,'delete'])->name('user.delete');

// 	// Route::view('/404-page','admin.404-page')->name('404-page');
// 	// Route::view('/blank-page','admin.blank-page')->name('blank-page');
// 	// Route::view('/buttons','admin.buttons')->name('buttons');
// 	// Route::view('/cards','admin.cards')->name('cards');
// 	// Route::view('/utilities-colors','admin.utilities-color')->name('utilities-colors');
// 	// Route::view('/utilities-borders','admin.utilities-border')->name('utilities-borders');
// 	// Route::view('/utilities-animations','admin.utilities-animation')->name('utilities-animations');
// 	// Route::view('/utilities-other','admin.utilities-other')->name('utilities-other');
// 	// Route::view('/chart','admin.chart')->name('chart');
// 	// Route::view('/tables','admin.tables')->name('tables');
// });

Route::group(['namespace' => 'Admin','middleware' => 'auth','prefix' => 'operator'],function(){
	Route::get('/',[DashboardAdmin::class,'render'])->name('admin')->middleware(['can:admin']);
	Route::put('/profile/update/{id}',[DashboardAdmin::class,'updateInitialData'])->name('updateOperator');

	Route::resource('/user','MahasiswaController')->middleware(['can:admin']);
	Route::get('/create-mahasiswa',[CreateMahasiswa::class,'render'])->name('create-mahasiswa')->middleware(['can:admin']);
    Route::post('/user',[MahasiswaController::class,'storeMahasiswa'])->name('user.store');
    Route::post('/user',[MahasiswaController::class,'storeMahasiswa'])->name('user.storeMahasiswa');

    Route::get('/user/edit/{id}',[MahasiswaController::class,'edit'])->name('user.edit');
    // Route::post('/user/update/{id}',[MahasiswaController::class,'update'])->name('user.update');
    Route::put('/operator/user/{id}',[MahasiswaController::class,'update'])->name('user.update');
    Route::get('/user/reset-password/{id}',[MahasiswaController::class,'resetPassword'])->name('user.reset-password');
    Route::get('/user/delete/{id}',[MahasiswaController::class,'delete'])->name('user.delete');

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
	Route::put('/khs/updateFile/{id}',[UserController::class,'updateFile'])->name('khs.updateFile');
	Route::post('/pkl',[UserController::class,'storePkl'])->name('pkl.store');
	Route::get('/pkl',[UserController::class,'pkl'])->name('pkl');
	Route::post('/skripsi',[UserController::class,'storeSkripsi'])->name('skripsi.store');
	Route::get('/skripsi',[UserController::class,'skripsi'])->name('skripsi');
	Route::put('/profile/update/{id}',[ProfileController::class,'update'])->name('profile.update');
	Route::put('/profile/initialUpdate/{id}',[ProfileController::class,'updateInitialData'])->name('profile.updateInitialData');
	Route::put('/profile/updateFoto/{id}',[ProfileController::class,'updateFoto'])->name('profile.updateFoto');
	Route::get('/profile/get-kota/{provinsi_id}', [ProfileController::class,'getKotaByProvinsi']);
});

// Dosen
Route::group(['middleware' => 'auth' ,'prefix' => 'dosen'],function(){
	Route::get('/',[DosenController::class,'index'])->name('dosen');
	Route::get('/listmahasiswa',[DosenController::class,'ListMhs'])->name('listmahasiswa');

	Route::get('/search',[DosenController::class,'search'])->name('dosen.search');
    Route::get('/mahasiswa/{nim}',[DosenController::class,'showDetail'])->name('dosen.detailSearch');
    // Route::get('/mahasiswa/{nim}/irs/{irs}',[DosenController::class,'showDetailIrs'])->name('dosen.detailIrs');

    Route::get('search/verifIrs/{irs}', [DosenController::class,'searchVerifikasiIrs'])->name('search.showVerifikasiIrs');
    Route::post('search/verifIrs/{irs}', [DosenController::class,'searchVerifIrs'])->name('search.verifIrs');
    Route::get('search/verifKhs/{khs}', [DosenController::class,'searchVerifikasiKhs'])->name('search.showVerifikasiKhs');
    Route::post('search/verifKhs/{khs}', [DosenController::class,'searchVerifKhs'])->name('search.verifKhs');
    Route::get('search/verifPkl/{pkl}', [DosenController::class,'searchVerifikasiPkl'])->name('search.showVerifikasiPkl');
    Route::post('search/verifPkl/{pkl}', [DosenController::class,'searchVerifPkl'])->name('search.verifPkl');
    Route::get('search/verifSkripsi/{skripsi}', [DosenController::class,'searchVerifikasiSkripsi'])->name('search.showVerifikasiSkripsi');
    Route::post('search/verifSkripsi/{skripsi}', [DosenController::class,'SearchVerifSkripsi'])->name('search.verifSkripsi');


	Route::get('/irs',[DosenController::class,'viewIrs'])->name('irs.index');
	Route::get('/khs',[DosenController::class,'viewKhs'])->name('khs.index');
	Route::get('/pkl',[DosenController::class,'viewPkl'])->name('pkl.index');
	Route::get('/skripsi',[DosenController::class,'viewSkripsi'])->name('skripsi.index');


    Route::get('irs/verif/{irs}', [DosenController::class,'showVerifikasiIrs'])->name('irs.showVerifikasi');
    Route::post('irs/verif/{irs}', [DosenController::class,'verifIrs'])->name('irs.verifIrs');
    Route::get('khs/verif/{khs}', [DosenController::class,'showVerifikasiKhs'])->name('khs.showVerifikasi');
    Route::post('khs/verif/{khs}', [DosenController::class,'verifKhs'])->name('khs.verifKhs');
    Route::get('pkl/verif/{pkl}', [DosenController::class,'showVerifikasiPkl'])->name('pkl.showVerifikasi');
    Route::post('pkl/verif/{pkl}', [DosenController::class,'verifPkl'])->name('pkl.verifPkl');
    Route::get('skripsi/verif/{skripsi}', [DosenController::class,'showVerifikasiSkripsi'])->name('skripsi.showVerifikasi');
    Route::post('skripsi/verif/{skripsi}', [DosenController::class,'verifSkripsi'])->name('skripsi.verifSkripsi');

	Route::put('/profile/updateFoto/{id}',[DosenController::class,'updateFoto'])->name('profiledosen.updateFoto');
	Route::put('/profile/update/{id}',[DosenController::class,'update'])->name('profiledosen.update');
	Route::get('/profile',[DosenController::class,'profile'])->name('profiledosen');


	// Route::post('/irs',[DosenController::class,'storeIrs'])->name('verif.irs');


});

// Departmen
Route::group(['middleware' => 'auth' ,'prefix' => 'departemen'],function(){
	Route::get('/',[DepartemenController::class,'index'])->name('departemen');
	Route::put('/profile/updateFoto/{id}',[DepartemenController::class,'updateFoto'])->name('profiledept.updateFoto');
	Route::put('/profile/update/{id}',[DepartemenController::class,'update'])->name('profiledept.update');
	Route::get('/profile',[DepartemenController::class,'profile'])->name('profiledept');
    Route::get('/mahasiswa',[DepartemenController::class,'listMahasiswa'])->name('departemen.mahasisaw');
    Route::get('/listMahasiswaAngkatan/{nim}',[DepartemenController::class,'listMahasiswaAngkatan'])->name('departemen.listMahasiswaAngkatan');
    Route::get('/mahasiswa/{status}/{angkatan}',[DepartemenController::class,'listMahasiswaStatus'])->name('departemen.listStatusMahasiswa');
    Route::get('/mahasiswa/cuti/{angkatan}',[DepartemenController::class,'mahasiswaCuti'])->name('departemen.mahasiswaCuti');


    Route::get('/search',[DepartemenController::class,'search'])->name('departemen.search');
    Route::get('/mahasiswa/{nim}',[DepartemenController::class,'showDetail'])->name('departemen.detailSearch');
    Route::get('/cetak-pdf/{angkatan}', [DepartemenController::class, 'cetakPdf'])->name('cetak.pdf');
    // Route::get('/mahasiswa/{nim}',[DosenController::class,'showDetail'])->name('dosen.detailSearch');



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
