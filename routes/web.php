<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AddusersController;
use App\Http\Controllers\sellerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\API\SocialAuthController;
use App\Http\Controllers\API\AuctionController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PaymentController;




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



Route::get('/', function () {
    return view('welcome');
});



 
/*------------------------------------------
--------------------------------------------
All Login Routes List
--------------------------------------------
--------------------------------------------*/

Auth::routes();

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
});


Route::group(['middleware'=>'disable_back'],function(){
Route::middleware(['auth', 'user-access:admin'])->group(function () {
Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
});


Route::group(['middleware'=>'disable_back'],function(){
Route::get('/bidder/home', [HomeController::class, 'bidderHome'])->name('bidder.home');
});
  

Route::group(['middleware'=>'disable_back'],function(){
Route::middleware(['auth', 'user-access:seller'])->group(function () {
Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('seller.home');
});
});


Route::group(['middleware'=>'disable_back'],function(){
Route::get('/login-google', [SocialAuthController::class, 'redirectToProvider'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleCallback'])->name('google.login.callback');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/logout/prompt', [App\Http\Controllers\BidderController::class, 'logoutPrompt'])->name('logout.prompt');
});

Route::middleware('auth')->group(function () {
Route::get('/users/status/{user_id}/{status_code}',[adminController::class, 'updateStatus'])->name('status.update');;
});

Route::middleware('auth')->group(function () {
Route::get('/applications/status/{user_id}/{status_code}',[adminController::class, 'appliactionStatus'])->name('applications.status');;
});

Route::middleware('auth')->group(function () {
Route::get('/products/status/{user_id}/{status_code}',[adminController::class, 'productStatus'])->name('product.status');;
});

Route::middleware('auth')->group(function () {
Route::get('/products/sold/{user_id}/{status_code}',[sellerController::class, 'productSold'])->name('product.sold');;
});

Route::middleware('auth')->group(function () {
Route::get('/products/posted/{user_id}/{status_code}',[sellerController::class, 'productPosted'])->name('product.posted');;
});

Route::middleware('auth')->group(function () {
Route::get('/expire/status/{user_id}/{status_code}',[sellerController::class, 'expire'])->name('expire.status');;
});



/*------------------------------------------
--------------------------------------------
Add users- ADMIN side
--------------------------------------------
--------------------------------------------*/

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/add/users', [App\Http\Controllers\adminController::class, 'addUsers'])->name('add.users');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::post('/add/users', [App\Http\Controllers\AddusersController::class, 'addUsers'])->name('add.users');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::post('/display/applications', [App\Http\Controllers\AddusersController::class, 'displayApplications'])->name('display.applications');
});


/*------------------------------------------
--------------------------------------------
Navigations 
--------------------------------------------
--------------------------------------------*/



Route::group(['middleware'=>'disable_back'],function(){
Route::get('/contacts', [App\Http\Controllers\HomeController::class, 'contacts'])->name('contacts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/adminHome', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/bidderHome', [App\Http\Controllers\HomeController::class, 'bidderHome'])->name('bidderHome');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/bidderHeader', [App\Http\Controllers\HomeController::class, 'bidderHeader'])->name('bidderHeader');
});



/*------------------------------------------
--------------------------------------------
All Display Routes - Admin Side
--------------------------------------------
--------------------------------------------*/

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/bidders', [App\Http\Controllers\adminController::class, 'displayBidders'])->name('display.bidders');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/sellers', [App\Http\Controllers\adminController::class, 'displaySellers'])->name('display.sellers');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/admins', [App\Http\Controllers\adminController::class, 'displayAdmins'])->name('display.admins');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/accounts', [App\Http\Controllers\adminController::class, 'displayAccounts'])->name('display.accounts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/applications', [App\Http\Controllers\adminController::class, 'displayApplications'])->name('display.applications');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/blocked', [App\Http\Controllers\adminController::class, 'displayBlocked'])->name('display.blocked');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/deactivated', [App\Http\Controllers\adminController::class, 'displayDeactivated'])->name('display.deactivated');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/admin/viewproducts', [App\Http\Controllers\adminController::class, 'adminViewproducts'])->name('admin.viewproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/admin/blockedproducts', [App\Http\Controllers\adminController::class, 'adminBlockedproducts'])->name('admin.blockedproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/admin/newproducts', [App\Http\Controllers\adminController::class, 'adminNewproducts'])->name('admin.newproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/unapprovedapplications', [App\Http\Controllers\adminController::class, 'displayUnapprovedapplications'])->name('display.unapprovedapplications');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/deniedapplications', [App\Http\Controllers\adminController::class, 'displayDeniedapplications'])->name('display.deniedapplications');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/bidder/wonbids', [App\Http\Controllers\HomeController::class, 'bidderWonbids'])->name('bidder.wonbids');
});

Route::post('/bid/{product_id}', [BidController::class, 'store']);
    
Route::group(['middleware'=>'disable_back'],function(){
Route::post('/shop', [App\Http\Controllers\BidderController::class, 'shop'])->name('shop');
});



Route::group(['middleware'=>'disable_back'],function(){
Route::get('/cartlist', [App\Http\Controllers\HomeController::class, 'cartlist'])->name('cartlist');
});

Route::group(['middleware'=>'disable_back'],function(){
    Route::match(['get', 'post'],'/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkoutpost');
});

/*------------------------------------------
--------------------------------------------
Applications
--------------------------------------------
--------------------------------------------*/


Route::get('/applications', [App\Http\Controllers\BidderController::class, 'applications'])->name('applications');
Route::post('/applications', [App\Http\Controllers\ApplicationController::class, 'applications'])->name('applications');

/*------------------------------------------
--------------------------------------------
Delete Buttons
--------------------------------------------
--------------------------------------------*/


Route::get('delete_bidders/{id}', 'App\Http\Controllers\adminController@delete_bidders');
Route::get('delete_sellers/{id}', 'App\Http\Controllers\adminController@delete_sellers');
Route::get('delete_admins/{id}', 'App\Http\Controllers\adminController@delete_admins');
Route::get('delete_accounts/{id}', 'App\Http\Controllers\adminController@delete_accounts');
Route::get('delete_applications/{id}', 'App\Http\Controllers\adminController@delete_applications');
Route::get('delete_blocked/{id}', 'App\Http\Controllers\adminController@delete_blocked');
Route::get('delete_deactivated/{id}', 'App\Http\Controllers\adminController@delete_deactivated');
Route::get('delete_cart/{id}', 'App\Http\Controllers\bidderController@delete_cart');

/*------------------------------------------
--------------------------------------------
View Image 
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/nationalfront/{id}', [App\Http\Controllers\adminController::class, 'displayNationalfront'])->name('display.nationalfront');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/nationalback/{id}', [App\Http\Controllers\adminController::class, 'displayNationalback'])->name('display.nationalback');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/prooffront/{id}', [App\Http\Controllers\adminController::class, 'displayProoffront'])->name('display.prooffront');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/display/proofback/{id}', [App\Http\Controllers\adminController::class, 'displayProofback'])->name('display.proofback');
});


/*------------------------------------------
--------------------------------------------
Download Image 
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware'=>'disable_back'],function(){
Route::get('/download/nationalfront/{file}', [App\Http\Controllers\adminController::class, 'downloadNationalfront'])->name('download.nationalfront');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/download/nationalback/{file}', [App\Http\Controllers\adminController::class, 'downloadNationalback'])->name('download.nationalback');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/download/prooffront/{file}', [App\Http\Controllers\adminController::class, 'downloadProoffront'])->name('download.prooffront');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/download/proofback/{file}', [App\Http\Controllers\adminController::class, 'downloadProofback'])->name('download.proofback');
});

/*------------------------------------------
--------------------------------------------
All Seller Routes
--------------------------------------------
--------------------------------------------*/

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/sellerHome', [App\Http\Controllers\HomeController::class, 'sellerHome'])->name('sellerHome');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/add/products', [App\Http\Controllers\HomeController::class, 'addProducts'])->name('add.products');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::post('/add/products', [App\Http\Controllers\sellerController::class, 'addProducts'])->name('add.products');
});



/*------------------------------------------
--------------------------------------------
All display product
--------------------------------------------
--------------------------------------------*/



Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/unapprovedproducts', [App\Http\Controllers\sellerController::class, 'sellerUnapprovedproducts'])->name('seller.unapprovedproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/postedproducts', [App\Http\Controllers\sellerController::class, 'sellerPostedproducts'])->name('seller.postedproducts');
});


Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/blockedproducts', [App\Http\Controllers\sellerController::class, 'sellerBlockedproducts'])->name('seller.blockedproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/displayproducts', [App\Http\Controllers\sellerController::class, 'sellerDisplayproducts'])->name('seller.displayproducts');
});

/*------------------------------------------
--------------------------------------------
edit product
--------------------------------------------
--------------------------------------------*/


Route::group(['middleware'=>'disable_back'],function(){
Route::get('seller/editproducts/{id}', [App\Http\Controllers\sellerController::class, 'sellerEditproducts'])->name('seller.editproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::put('seller/editproducts/{id}', [App\Http\Controllers\sellerController::class, 'editProducts'])->name('edit.products');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/sold/products', [App\Http\Controllers\sellerController::class, 'soldProducts'])->name('sold.products');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/restartauction/{product_id}', [App\Http\Controllers\sellerController::class, 'sellerRestartAuction'])->name('seller.restartauction');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::put('/seller/restartauction/{product_id}', [App\Http\Controllers\sellerController::class, 'sellerRestart'])->name('seller.restart');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/notifybidder', [App\Http\Controllers\sellerController::class, 'sellerNotifybidder'])->name('seller.notifybidder');
});




/*------------------------------------------
--------------------------------------------
Delete Buttons
--------------------------------------------
--------------------------------------------*/


Route::get('delete_products/{id}', 'App\Http\Controllers\sellerController@delete_products');
Route::get('delete_products/{id}', 'App\Http\Controllers\adminController@delete_products');
Route::get('delete_posted/{product_id}', 'App\Http\Controllers\sellerController@delete_posted');
    
    




Route::get('createAuction', [App\Http\Controllers\AuctionController::class, 'store'])->name('create.Auction');




/*------------------------------------------
--------------------------------------------
Bidding Process
--------------------------------------------
--------------------------------------------*/

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/approvedproducts', [App\Http\Controllers\sellerController::class, 'sellerApprovedproducts'])->name('seller.approvedproducts');
});


Route::group(['middleware'=>'disable_back'],function(){
Route::post('/seller/approvedproducts', [App\Http\Controllers\BidController::class, 'sellerApprovedproducts'])->name('seller.approvedproducts');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/endedauction', [App\Http\Controllers\sellerController::class, 'sellerEndedauction'])->name('seller.endedauction');
});




/*------------------------------------------
--------------------------------------------
Analysis
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware'=>'disable_back'],function(){
Route::get('/admin/analysis', [App\Http\Controllers\ChartController::class, 'adminAnalysis'])->name('admin.analysis');
});

Route::group(['middleware'=>'disable_back'],function(){
Route::get('/seller/analysis', [App\Http\Controllers\ChartController::class, 'sellerAnalysis'])->name('seller.analysis');
});











Route::controller(PaymentController::class)
->prefix('payments')
->as('payments')
->group(function(){
    Route::get('/initiatepush','initiateStkPush')->name('initiatepush');
    Route::get('/stkcallback','stkCallback')->name('stkcallback');
    Route::get('/stkquery','stkQuery')->name('stkquery');
    Route::get('/registerurl','registerUrl')->name('registerurl');
    Route::post('/validation','Validation')->name('validation');
    Route::post('/confirmation','Confirmation')->name('confirmation');
    Route::get('/simulate','Simulate')->name('simulate');
    Route::get('/qrcode','qrcode')->name('qrcode');
    Route::get('/b2c','b2c')->name('b2c');
    Route::post('/b2cresult','b2cResult')->name('b2cresult');
    Route::post('/b2ctimeout','b2cTimeout')->name('b2ctimeout');
    Route::get('/reversal','Reversal')->name('reversal');
    Route::post('/reversalresult','reversalResult')->name('reversalresult');
    Route::post('/reversaltimeout','reversalTimeout')->name('reversaltimeout');
}); 
    


