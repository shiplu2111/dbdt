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
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\WithdrawSettingController;
use App\Http\Controllers\DepositMethodController;
use App\Http\Controllers\MastercardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\StakeController;
use App\Http\Controllers\PackUpgradeController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\StakeMethodController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TwoXvaluePackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommisionController;
use App\Http\Controllers\CompanyAccountController;
use App\Http\Controllers\CronController;



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/c', [CronController::class, 'index']);
Route::get('/freez-dbdt-cron-run', [CronController::class, 'index']);


Route::get('/', [FrontendController::class, 'index'])->name('frontpage');
Route::get('/buy-dbdt', [FrontendController::class, 'buydbdt'])->name('buydbdt');
Route::get('/login-or-register', [FrontendController::class, 'loginregister'])->name('loginregister');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-msg-submit', [ContactController::class, 'index'])->name('contact.add');
Route::get('/about-us', [FrontendController::class, 'about_us'])->name('about_us');

Route::get('user/verify', [DbdtuserController::class, 'verify'])->name('verify');
Route::get('user/nid/verify', [DbdtuserController::class, 'nid_verify'])->name('nid_verify');
Route::get('user/passport/verify', [DbdtuserController::class, 'passport_verify'])->name('passport_verify');

Route::get('/stack-bonus-cron', [FrontendController::class, 'stack_bonus_cron_job']);
Route::get('/stack-bonus-daily-cron', [FrontendController::class, 'stack_bonus_daily_cron_job']);


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('dashboard');
});


Route::post('getstackmethoddatabyid', [StakeMethodController::class, 'getstackmethoddatabyid']);

Route::get('/markAsRead/{id}',function($id){
auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    // auth()->user()->unreadNotifications->markAsRead();
});


Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'is.admin'])->group(function () {
    Route::get('/dashboard', [DbdtadminController::class, 'index'])->name('dashboard.admin');
     Route::get('/user-list', [DbdtadminController::class, 'userlist'])->name('userlist');
     Route::get('/active-user-list', [DbdtadminController::class, 'active_user_list']);
     Route::get('/inactive-user-list', [DbdtadminController::class, 'inactive_user_list']);
     Route::get('/banned-user-list', [DbdtadminController::class, 'banned_user_list']);
     Route::get('/user/active/{id}', [DbdtadminController::class, 'activeuser'])->name('activeuser');
     Route::get('/user/inactive/{id}', [DbdtadminController::class, 'inactiveuser'])->name('inactiveuser');
     Route::get('/user/ban/{id}', [DbdtadminController::class, 'banuser'])->name('banuser');
//user details
    Route::get('/user/details/{id}', [DbdtadminController::class, 'user_details']);
    Route::get('/user/delete/{id}', [DbdtadminController::class, 'user_delete']);
    Route::post('/user/kyc/reject', [DbdtadminController::class, 'kyc_reject']);
    Route::get('/user/kyc/accept/{id}', [DbdtadminController::class, 'kyc_accept']);



     Route::get('/admin-list', [DbdtadminController::class, 'adminlist'])->name('adminlist');
     Route::get('/admin-add', [DbdtadminController::class, 'adminadd'])->name('adminadd');
     Route::get('/admin/active/{id}', [DbdtadminController::class, 'activeadmin'])->name('activeadmin');
     Route::get('/admin/inactive/{id}', [DbdtadminController::class, 'inactiveadmin'])->name('inactiveadmin');
     Route::get('/admin/ban/{id}', [DbdtadminController::class, 'banadmin'])->name('banadmin');
     Route::post('/registeradmin', [DbdtadminController::class, 'registeradmin'])->name('registeradmin');
     Route::post('/swap-dbdt', [DbdtadminController::class, 'swap_dbdt'])->name('swap.dbdt');

    //  20/1/2022
     Route::get('/website/setting', [SettingController::class, 'index']);
     Route::post('/website-setting', [SettingController::class, 'update'])->name('website.setting');
     Route::post('/logo-add', [SettingController::class, 'logo_add'])->name('logo.add');
     Route::post('/fev-icon-add', [SettingController::class, 'fev_icon_add'])->name('fev.icon.add');


     Route::get('/commision/setting', [CommisionController::class, 'index']);
     Route::post('/commision-add', [CommisionController::class, 'store'])->name('commision.add');
     Route::get('/commision-level-check/{id}', [CommisionController::class, 'check']);
     Route::get('/commision/edit/{id}', [CommisionController::class, 'getValue']);
     Route::post('/commision-update', [CommisionController::class, 'update'])->name('commision.update');
     Route::get('/commision/delete/{id}', [CommisionController::class, 'distroy']);

     Route::get('/commision', [CommisionController::class, 'test']);

    //  20/1/2022
    Route::get('/pending/kyc/request', [DbdtadminController::class, 'kyc_requests']);
    Route::get('/kyc/details/{id}', [DbdtadminController::class, 'kyc_details']);
    Route::get('/all/kyc/request', [DbdtadminController::class, 'all_kyc_requests']);





    // 24/1
    Route::get('/withdraw/setting', [WithdrawSettingController::class, 'index']);
    Route::post('/withdraw-setting-add', [WithdrawSettingController::class, 'store'])->name('withdraw.setting.add');
 // 25/1
    Route::get('/deposit/method/setting', [DepositMethodController::class, 'index']);
    Route::post('/deposit/method/add', [DepositMethodController::class, 'store'])->name('deposit.method.add');
    Route::get('/deposit/method/{id}', [DepositMethodController::class, 'getMethodById']);
    Route::post('/update-deposit-method', [DepositMethodController::class, 'updateDepositMethod'])->name('method_deposit.update');
    Route::post('/delete-deposit-method/{id}', [DepositMethodController::class, 'destroy']);



// 25/1
    Route::get('/mastercard/applications', [DbdtadminController::class, 'mastercard']);
    Route::post('/mastercard/active', [DbdtadminController::class, 'active_master_cards'])->name('active_master_cards');
    Route::get('/mastercard/inactive/{id}', [DbdtadminController::class, 'inactive_master_cards'])->name('inactive_master_cards');
    Route::get('/mastercard/ban/{id}', [DbdtadminController::class, 'ban_master_cards'])->name('ban_master_cards');
    Route::get('/mastercard/application/details/{id}', [DbdtadminController::class, 'mastercard_application_detail']);
    Route::get('/mastercard/application/edit/{id}', [DbdtadminController::class, 'mastercard_application_edit']);
    Route::post('/mastercard/application/update', [DbdtadminController::class, 'mastercard_application_update'])->name('mastercard.update');



// stack
    Route::get('/stake/method/setting', [StakeMethodController::class, 'index']);
    Route::post('/stake/method/add', [StakeMethodController::class, 'store'])->name('stake.method_add');
    Route::get('/stake/{id}', [StakeMethodController::class, 'getStakeById']);




    Route::post('/stake/method/update', [StakeMethodController::class, 'update'])->name('stake.pack_update');
    Route::get('/stake/method/delete/{id}', [StakeMethodController::class, 'destroy']);

    Route::get('/withdraw/list', [WithdrawController::class, 'withdraw_list']);
    Route::get('/withdraw/details/{id}', [WithdrawController::class, 'withdraw_details']);

    Route::get('/stakes', [StakeController::class, 'admin_index']);
    Route::get('/stake/details/{id}', [StakeController::class, 'details']);
    Route::get('/stake/accept/{id}', [StakeController::class, 'accept']);
    Route::get('/stake/reject/{id}', [StakeController::class, 'reject']);

    Route::get('/package-sales-report', [ReportController::class, 'index']);
    Route::post('/package-sales-report', [ReportController::class, 'search'])->name('sales_report_search');

    Route::get('/package/sales/details/{id}', [PackageController::class, 'pack_sales_details']);





    Route::post('/withdraw/accept', [WithdrawController::class, 'accept']);
    Route::get('/withdraw/deny/{id}', [WithdrawController::class, 'deny']);

    Route::get('/all-deposit', [DepositController::class, 'depositShow']);
    Route::get('/deposit/deny/{id}', [DepositController::class, 'deny']);
    Route::get('/deposit/details/{id}', [DepositController::class, 'admindetails']);
    Route::get('/deposit/accept/{id}', [DepositController::class, 'accept']);

    Route::get('/all-transfers', [TransferController::class, 'adminShow']);
    Route::get('/add-credit', [CreditController::class, 'addCredit']);
     Route::post('/add-credit/autocomplete', [DbdtadminController::class, 'fetch'])->name('autocomplete.fetch');
    Route::post('/add-credit', [CreditController::class, 'add'])->name('credit.add');




    Route::get('/order', [OrderController::class, 'order']);
    Route::get('/packages', [PackageController::class, 'index']);
    Route::post('/add-package', [PackageController::class, 'addPackage'])->name('package.add');
    Route::get('/package/{id}', [PackageController::class, 'getPackageById']);
    Route::post('/update-package', [PackageController::class, 'updatePackage'])->name('package.update');


     Route::get('/methods', [MethodController::class, 'index'])->name('methods');
     Route::post('/add-method', [MethodController::class, 'addMethod'])->name('method.add');
     Route::get('/method/{id}', [MethodController::class, 'getMethodById']);
     Route::post('/update-method', [MethodController::class, 'updateMethod'])->name('method.update');
     Route::delete('/method/{id}', [MethodController::class, 'destroyMethod']);

     Route::get('/package/deposit/pending', [DbdtadminController::class, 'package_deposit_pending']);
    Route::get('/package-upgrade/deposit/pending', [DbdtadminController::class, 'package_upgrade_deposit_pending']);

    Route::get('/pending/deposit/accept/{id}', [CommisionController::class, 'deposit_accept']);
    Route::get('/pending/deposit/reject/{id}', [DbdtadminController::class, 'deposit_reject']);


    Route::get('/pending/upgrade/accept/{id}', [OrderController::class, 'upgrade_accept']);

     Route::get('/mail-box', [ContactController::class, 'show'])->name('contact.messages');

     Route::get('/user-incomes', [IncomeController::class, 'user_incomes']);

});




Route::prefix('user')->middleware(['auth:sanctum', 'verified', 'is.user'])->group(function () {
Route::get('/identity-document', [DbdtuserController::class, 'kyc_verification']);
Route::post('/identity-document-submit', [DbdtuserController::class, 'identity_submit'])->name('identity.submit');

Route::get('/nid-kyc-submit', [DbdtuserController::class, 'nid_kyc_submit_show']);
Route::get('/nid-back-submit', [DbdtuserController::class, 'nid_back_show']);
Route::get('/nid-selfie', [DbdtuserController::class, 'nid_selfie_show']);

Route::post('/nid-submit-front', [DbdtuserController::class, 'nid_submit_front']);
Route::post('/nid-submit-back', [DbdtuserController::class, 'nid_submit_back']);
Route::post('/nid-selfie-submit', [DbdtuserController::class, 'nid_submit_selfie']);


Route::post('/passport-submit', [DbdtuserController::class, 'passport_submit'])->name('passport.submit');
Route::get('/selfie',[DbdtuserController::class, 'selfie_submit_show']);
Route::post('/selfie-submit', [DbdtuserController::class, 'selfie_submit'])->name('selfie.submit');
Route::post('/address-submit', [DbdtuserController::class, 'address_submit'])->name('address.submit');
Route::get('/address-kyc-submit', [DbdtuserController::class, 'address_kyc_submit']);
Route::get('/kyc-status', [DbdtuserController::class, 'kyc_status']);


Route::get('/passport-kyc-submit', [DbdtuserController::class, 'passport_kyc_submit_show']);

});




Route::post('image-upload', [ DbdtuserController::class, 'imageUploadPost' ])->name('nid.upload');



    Route::prefix('user')->middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/profile/update', [DbdtuserController::class, 'profile_show']);
    Route::post('/profile/photo/upload', [DbdtuserController::class, 'store'])->name('profile.photo.add');
    Route::post('/profile/photo/delete/{id}', [DbdtuserController::class, 'destroyProfilePhoto']);
    Route::post('/update-user-data', [DbdtuserController::class, 'updateUserData'])->name('update.user.data');

    });
    Route::middleware(['auth:sanctum', 'verified', 'is.user','is.active','is.kyc'])->group(function () {
        Route::get('/stake-dbdt', [FrontendController::class, 'stakedbdt'])->name('stakedbdt');


    Route::get('/mastercard', [FrontendController::class, 'mastercard'])->name('mastercard');
    Route::get('/mastercard-signup-step-two', [MastercardController::class, 'stepOne'])->name('mastercard.stepOne');
    Route::get('/mastercard-signup-step-three', [MastercardController::class, 'stepTwo'])->name('mastercard.stepTwo');
    Route::get('/mastercard-signup-final-step', [MastercardController::class, 'stepThree'])->name('mastercard.stepThree');
    Route::post('/mastercard-signup-finish', [MastercardController::class, 'finalStep'])->name('mastercard.finalStep');
    });

    Route::prefix('user')->middleware(['auth:sanctum', 'verified','is.user','is.active','is.kyc'])->group(function () {

    Route::get('/new-swap', [SwapController::class, 'index']);
    Route::post('/new-swap', [SwapController::class, 'store'])->name('swap.new');


    Route::post('/mastercard-payment', [MastercardController::class, 'mastercard_payment']);
    Route::get('/mastercard/details', [MastercardController::class, 'mastercard']);
    Route::get('/payment/setting', [PaymentMethodController::class, 'index']);
    Route::post('/payment-address-add', [PaymentMethodController::class, 'my_payment_method_add'])->name('my.payment.method.add');
    Route::get('/downline/tree', [DbdtuserController::class, 'tree']);
    Route::get('/new-withdraw', [WithdrawController::class, 'index']);
    Route::get('/all-withdraws', [WithdrawController::class, 'show']);
    Route::get('/withdraw/details/{id}', [WithdrawController::class, 'user_withdraw_details']);

    Route::post('/withdraw-user-dbdt', [WithdrawController::class, 'withdraw'])->name('withdraw.dbdt');
    Route::post('/withdraw-otpVerify', [WithdrawController::class, 'otpVerify'])->name('withdraw.otpVerify');

    Route::get('/upgrade-package', [DbdtuserController::class, 'package_upgrade']);
    Route::get('/confirm-package/upgrade/{id}', [PackInvoiceController::class, 'confirm_package_upgrade']);
    Route::get('/package/upgrade/{id}', [PackInvoiceController::class, 'package_upgrade_store']);
    Route::get('/new-deposit', [DepositController::class, 'index']);
    Route::post('/new-deposit', [DepositController::class, 'store']);
    Route::get('/all-deposit', [DepositController::class, 'show']);
    Route::get('/deposit/details/{id}', [DepositController::class, 'userdetails']);
    Route::get('/new-transfer', [TransferController::class, 'index']);
    Route::post('/new-transfer-create', [TransferController::class, 'transfer'])->name('transfer.dbdt');
    Route::get('/all-transfers', [TransferController::class, 'show']);
    Route::get('/received/transfers', [TransferController::class, 'show_received']);
    Route::post('/upgrade-invoice-payment', [PackUpgradeController::class, 'payment'])->name('package.upgrade.payment');
    Route::post('/upgrade-by-balance', [PackUpgradeController::class, 'upgrade_by_balance'])->name('upgrade.by.balance');
    Route::post('/stack-dbdt-now', [StakeController::class, 'store'])->name('stack.add');
    Route::get('/my-stack/list', [StakeController::class, 'show']);
    Route::get('/my-incomes', [IncomeController::class, 'index']);
    Route::get('/stake/cancel/{id}', [StakeController::class, 'cancelStake']);


});

// Route::get('/base', [DbdtuserController::class, 'base']);





Route::prefix('user')->middleware(['auth:sanctum', 'verified',  'is.user'])->group(function () {
    Route::get('/dashboard', [DbdtuserController::class, 'index'])->name('dashboard.user');
    Route::get('/available-packages', [DbdtuserController::class, 'packageshow'])->name('available.packages');
    Route::get('/confirm-package/{id}', [PackInvoiceController::class, 'confirm_package'])->name('package.confirm');
    Route::post('/invoice-payment', [OrderController::class, 'payment'])->name('package.payment');
    Route::get('/my-packages', [PackInvoiceController::class, 'my_packages']);
    Route::get('/package-details/{id}', [PackInvoiceController::class, 'details_packages']);
    Route::get('/delete-packages/{id}', [PackInvoiceController::class, 'destroy']);

    // Route::get('/profile', [DbdtuserController::class, 'profile'])->name('profile.user');

    Route::get('/add-to-cart-package/{id}', [OrderController::class, 'index']);
    Route::get('/add-to-cart-package-upgrade/{id}', [OrderController::class, 'upgrade']);

    Route::post('/upgrade-payment', [OrderController::class, 'upgradePayment'])->name('upgrade.payment');
    Route::get('/upgrade-payment/using-dbdt', [OrderController::class, 'upgradePaymentDBDT']);

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
Route::get('/{any}', [FrontendController::class, 'not_found'])->where('any', '.*');
