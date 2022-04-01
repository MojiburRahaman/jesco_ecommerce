 <?php

use App\Http\Controllers\BestDealController;
use App\Http\Controllers\BlogController;
    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\CartController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductViewController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SizeController;
    use App\Http\Controllers\SubCatagoryController;
    use App\Http\Controllers\UserProfileController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\SslCommerzPaymentController;

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

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');

    // frontend route start
    Route::get('/', [FrontendController::class, 'Frontendhome'])->name('Frontendhome');
    Route::get('/faq', [FrontendController::class, 'FrontendFaQ'])->name('FrontendFaQ');
    Route::get('/about', [FrontendController::class, 'FrontendAbout'])->name('FrontendAbout');
    Route::get('/contact', [FrontendController::class, 'FrontendContact'])->name('FrontendContact');
    Route::post('/contact/post', [FrontendController::class, 'FrontendContactPost'])->name('FrontendContactPost');
    Route::get('/search', [FrontendController::class, 'FrontendSearch'])->name('FrontendSearch');
    Route::get('/deals', [FrontendController::class, 'FrontendDeals'])->name('FrontendDeals');
    Route::get('/product/{slug}', [ProductViewController::class, 'SingleProductView'])->name('SingleProductView');
    Route::post('/product/get-size', [ProductViewController::class, 'GetSizeByColor'])->name('GetSizeByColor');
    Route::post('/product/get-pricebysize', [ProductViewController::class, 'GetPriceBySize'])->name('GetPriceBySize');
    Route::get('/shop', [FrontendController::class, 'Frontendshop'])->name('Frontendshop');

    // blog route
    Route::get('/blogs', [FrontendController::class, 'Frontendblog'])->name('Frontendblog');
    Route::get('/blog/{slug}', [FrontendController::class, 'FrontenblogView'])->name('FrontenblogView');
    Route::post('/blog/comment', [FrontendController::class, 'BlogComment'])->name('BlogComment');
    Route::post('/blog/reply', [FrontendController::class, 'BlogReply'])->name('BlogReply');


    // search route start
    Route::get('/product-category/{slug}', [SearchController::class, 'CategorySearch'])->name('CategorySearch');
    // search route end

    // cart route start
    Route::get('/cart', [CartController::class, 'CartView'])->name('CartView');
    Route::post('/cart/coupon', [CartController::class, 'CouponCheck'])->name('CouponCheck');
    // Route::get('/cart/{coupon_name}', [CartController::class, 'CartView']);
    Route::get('/cart/cart-delete/{id}', [CartController::class, 'CartDelete'])->name('CartDelete');
    Route::post('/cart/cart-clear/', [CartController::class, 'CartClear'])->name('CartClear');
    Route::post('/cart/quantity-update', [CartController::class, 'CartUpdate'])->name('CartUpdate');
    Route::post('/cartpost', [CartController::class, 'CartPost'])->name('CartPost');

    // cart route end
    Route::middleware(['auth', 'checkcoustomer','verified'])->group(function () {
        // Profile route
        Route::get('/profile', [UserProfileController::class, 'FrontendProfile'])->name('FrontendProfile');
        Route::put('/profile/update', [UserProfileController::class, 'ProfileUpdate'])->name('ProfileUpdate');
        Route::patch('/profile/change-password', [UserProfileController::class, 'ChangeUserPass'])->name('ChangeUserPass');
        // wishlist route start
        Route::get('/wishlist', [WishlistController::class, 'WishlistView'])->name('WishlistView');
        Route::post('/wishlist-post', [WishlistController::class, 'WishlistPost'])->name('WishlistPost');
        Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishlistRemove'])->name('WishlistRemove');
        // wishlist route end

        // checkout route start
        Route::get('/checkout', [CheckoutController::class, 'CheckoutView'])->name('CheckoutView');
        Route::post('/checkout-post', [CheckoutController::class, 'CheckoutPost'])->name('CheckoutPost');
        Route::post('/checkout-pay', [CheckoutController::class, 'PayNow'])->name('PayNow');

        Route::post('/checkout/billing/division_id', [CheckoutController::class, 'CheckoutajaxDivid'])->name('CheckoutajaxDivid');
        Route::post('/checkout/billing/disctrict_id', [CheckoutController::class, 'CheckoutajaxDistrictid'])->name('CheckoutajaxDistrictid');

        // checkout route end

        // SSLCOMMERZ Start

        Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
        // Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

        Route::post('/success', [SslCommerzPaymentController::class, 'success']);
        Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
        Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

        // Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
        //SSLCOMMERZ END

    });

    // frontend route end

    Route::get('/admin/login', [DashboardController::class, 'AdminLogin'])->name('AdminLogin')->middleware('guest', 'throttle:10,5');
    Route::post('/admin/login', [DashboardController::class, 'AdminLoginPost'])->name('AdminLoginPost')->middleware('guest', 'throttle:10,5');
    // backend route start
    Route::middleware(['auth', 'checkadminpanel'])->prefix('admin')->group(function () {
        // dashboard route
        Route::get('/change-password', [DashboardController::class, 'AdminChangePassword'])->name('AdminChangePassword');
        Route::post('/change-password', [DashboardController::class, 'AdminChangePasswordPost'])->name('AdminChangePasswordPost');
        Route::resource('/dashboard', DashboardController::class);
        Route::get('/order', [DashboardController::class,'DashboardOrder'])->name('DashboardOrder');
        Route::get('/order/details/{id}', [DashboardController::class,'OrderDetails'])->name('OrderDetails');
        Route::get('/order/invoice/{id}', [DashboardController::class,'InvoiceDownload'])->name('InvoiceDownload');
        Route::get('/order/delivery/{id}', [DashboardController::class,'DeliveryStatus'])->name('DeliveryStatus');

        // catagory route
        Route::get('/catagory/add-to-home/{id}', [CatagoryController::class, 'CategoryAddToHome'])->name('CategoryAddToHome');
        Route::post('/catagory/mark-delete', [CatagoryController::class, 'MarkdeleteCatagory'])->name('MarkdeleteCatagory');
        Route::resource('/catagory', CatagoryController::class);

        // subcatagory route
        Route::post('/sub-catagory/mark-delete', [SubCatagoryController::class, 'MarkdeleteSubCatagory'])->name('MarkdeleteSubCatagory');
        Route::resource('/subcatagory', SubCatagoryController::class);

        // product route

        Route::get('/products/status/{id}', [ProductController::class, 'ProductStaus'])->name('ProductStaus');
        Route::post('/products/mark-delete/', [ProductController::class, 'MarkdeleteProduct'])->name('MarkdeleteProduct');
        Route::get('/products/edit/product-attribute-delete/{id}', [ProductController::class, 'ProducvtAtributeDelete'])->name('ProducvtAtributeDelete');
        Route::get('/products/edit/product-flavour-delete/{id}', [ProductController::class, 'ProductFlavourDelete'])->name('ProductFlavourDelete');
        Route::get('/products/edit/product-image-delete/{id}', [ProductController::class, 'ProductImagesDelete'])->name('ProductImagesDelete');
        Route::get('/products/get-sub-cat/{cat_id}', [ProductController::class, 'GetSubcatbyAjax'])->name('GetSubcatbyAjax');
        Route::resource('/products', ProductController::class);

        //    roles route
        Route::get('/roles/add-user', [RoleController::class, 'CreateUser'])->name('CreateUser');
        Route::post('/roles/add-user-post', [RoleController::class, 'CreateUserPost'])->name('CreateUserPost');
        Route::post('/roles/assign-user-post', [RoleController::class, 'AssignUserPost'])->name('AssignUserPost');
        Route::get('/roles/assign-user', [RoleController::class, 'AssignUser'])->name('AssignUser');
        Route::resource('/roles', RoleController::class);
        //    coupon route
        Route::resource('/coupons', CouponController::class);
        // color route
        Route::resource('/color', ColorController::class);
        // size route
        Route::resource('/size', SizeController::class);
        // 
        Route::post('/blogs/ckeditor-fileupload', [BlogController::class, 'CkfileUpload'])->name('CkfileUpload');
        Route::resource('/blogs', BlogController::class);
        Route::resource('/deals', BestDealController::class)->except('edit', 'update');

        Route::get('settings/faq', [SiteSettingController::class, 'SiteFaqView'])->name('SiteFaqView');
        Route::post('settings/faq/create', [SiteSettingController::class, 'SiteFaqCreate'])->name('SiteFaqCreate');
        Route::get('settings/faq/delete/{id}', [SiteSettingController::class, 'SiteFaqDelete'])->name('SiteFaqDelete');
        Route::get('settings/about/{id}', [SiteSettingController::class, 'SiteAbout'])->name('SiteAbout');
        Route::post('settings/about', [SiteSettingController::class, 'SiteAboutUpdate'])->name('SiteAboutUpdate');
        Route::get('settings/banner-status/{id}', [SiteSettingController::class, 'SiteBannerStatus'])->name('SiteBannerStatus');
        Route::get('settings/banner-delete/{id}', [SiteSettingController::class, 'SiteBannerDelete'])->name('SiteBannerDelete');
        Route::post('settings/banner-post', [SiteSettingController::class, 'SiteBannerPost'])->name('SiteBannerPost');
        Route::get('settings/banner', [SiteSettingController::class, 'SiteBanner'])->name('SiteBanner');
        Route::post('settings/subscriber', [SiteSettingController::class, 'SiteSubscriber'])->name('SiteSubscriber');
        Route::resource('/settings', SiteSettingController::class)->except('show', 'destroy', 'index', 'store');


    });

















    // backend route start

    require __DIR__ . '/auth.php';
