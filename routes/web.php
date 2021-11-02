 <?php

    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\CartController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductViewController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\SearchController;
    use App\Http\Controllers\SizeController;
    use App\Http\Controllers\SubCatagoryController;

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
    Route::get('/product/{slug}', [ProductViewController::class, 'SingleProductView'])->name('SingleProductView');
    Route::post('/product/get-size', [ProductViewController::class, 'GetSizeByColor'])->name('GetSizeByColor');
    Route::post('/product/get-pricebysize', [ProductViewController::class, 'GetPriceBySize'])->name('GetPriceBySize');
    Route::get('/shop', [FrontendController::class, 'Frontendshop'])->name('Frontendshop');

    // search route start
    Route::get('/product-category/{slug}', [SearchController::class, 'CategorySearch'])->name('CategorySearch');
    // search route end
    // cart route start
    Route::get('/cart', [CartController::class, 'CartView'])->name('CartView');
    Route::get('/cart/{coupon_name}', [CartController::class, 'CartView']);
    Route::get('/cart/cart-delete/{id}', [CartController::class, 'CartDelete'])->name('CartDelete');
    Route::post('/cart/cart-clear/', [CartController::class, 'CartClear'])->name('CartClear');
    Route::post('/cart/quantity-update', [CartController::class, 'CartUpdate'])->name('CartUpdate');
    Route::post('/cartpost', [CartController::class, 'CartPost'])->name('CartPost');

    // cart route end


    // frontend route end


    // backend route start
    Route::middleware(['auth','checkadminpanel'])->group(function () {
        // dashboard route
        Route::resource('dashboard', DashboardController::class);

        // catagory route
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
    });

















    // backend route start

    require __DIR__ . '/auth.php';
