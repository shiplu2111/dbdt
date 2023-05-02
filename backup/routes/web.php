<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Dashboard\DbdtadminController;
use App\Http\Controllers\Dashboard\DbdtuserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackInvoiceController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ContactController;
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
//     return view('welcome');
// });



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



Route::get('/', [FrontendController::class, 'index'])->name('frontpage');
Route::get('/buy-dbdt', [FrontendController::class, 'buydbdt'])->name('buydbdt');
Route::get('/stake-dbdt', [FrontendController::class, 'stakedbdt'])->name('stakedbdt');
Route::get('/mastercard', [FrontendController::class, 'mastercard'])->name('mastercard');
Route::get('/login-or-register', [FrontendController::class, 'loginregister'])->name('loginregister');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-msg-submit', [ContactController::class, 'index'])->name('contact.add');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('dashboard');
});







Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'is.admin'])->group(function () {
    Route::get('/dashboard', [DbdtadminController::class, 'index'])->name('dashboard.admin');
     Route::get('/user-list', [DbdtadminController::class, 'userlist'])->name('userlist');
     Route::get('/user/active/{id}', [DbdtadminController::class, 'activeuser'])->name('activeuser');
     Route::get('/user/inactive/{id}', [DbdtadminController::class, 'inactiveuser'])->name('inactiveuser');
     Route::get('/user/ban/{id}', [DbdtadminController::class, 'banuser'])->name('banuser');

     Route::get('/admin-list', [DbdtadminController::class, 'adminlist'])->name('adminlist');
     Route::get('/admin-add', [DbdtadminController::class, 'adminadd'])->name('adminadd');
     Route::get('/admin/active/{id}', [DbdtadminController::class, 'activeadmin'])->name('activeadmin');
     Route::get('/admin/inactive/{id}', [DbdtadminController::class, 'inactiveadmin'])->name('inactiveadmin');
     Route::get('/admin/ban/{id}', [DbdtadminController::class, 'banadmin'])->name('banadmin');
     Route::post('/registeradmin', [DbdtadminController::class, 'registeradmin'])->name('registeradmin');



     Route::get('/packages', [PackageController::class, 'index'])->name('packages');
     Route::post('/add-package', [PackageController::class, 'addPackage'])->name('package.add');
     Route::get('/package/{id}', [PackageController::class, 'getPackageById']);
     Route::post('/update-package', [PackageController::class, 'updatePackage'])->name('package.update');
     Route::delete('/package/{id}', [PackageController::class, 'destroyPackage']);

     Route::get('/methods', [MethodController::class, 'index'])->name('methods');
     Route::post('/add-method', [MethodController::class, 'addMethod'])->name('method.add');
     Route::get('/method/{id}', [MethodController::class, 'getMethodById']);
     Route::post('/update-method', [MethodController::class, 'updateMethod'])->name('method.update');
     Route::delete('/method/{id}', [MethodController::class, 'destroyMethod']);

     Route::get('/package/deposit/pending', [DbdtadminController::class, 'package_deposit_pending']);
     Route::get('/pending/deposit/accept/{id}', [DbdtadminController::class, 'deposit_accept']);

     Route::get('/mail-box', [ContactController::class, 'show'])->name('contact.messages');


});


Route::prefix('user')->middleware(['auth:sanctum', 'verified', 'is.user'])->group(function () {
    Route::get('/available-packages', [DbdtuserController::class, 'packageshow'])->name('available.packages');
    Route::get('/confirm-package/{id}', [PackInvoiceController::class, 'confirm_package'])->name('package.confirm');
    Route::post('/invoice-payment', [PackInvoiceController::class, 'payment'])->name('package.payment');
    Route::get('/my-packages', [PackInvoiceController::class, 'my_packages']);
    Route::get('/package-details/{id}', [PackInvoiceController::class, 'details_packages']);
    Route::get('/delete-packages/{id}', [PackInvoiceController::class, 'destroy']);


    Route::get('/payment/setting', [PaymentMethodController::class, 'index']);
    Route::post('/payment-address-add', [PaymentMethodController::class, 'my_payment_method_add'])->name('my.payment.method.add');

});







Route::prefix('user')->middleware(['auth:sanctum', 'verified', 'is.user'])->group(function () {
    Route::get('/dashboard', [DbdtuserController::class, 'index'])->name('dashboard.user');
    // Route::get('/profile', [DbdtuserController::class, 'profile'])->name('profile.user');

});









//Clear Cache facade value:
Route::get('/cc', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/ccc', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/cccc', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/ccccc', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/cccccc', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/ccccccc', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
















Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
