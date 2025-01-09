<?php

use Livewire\Livewire;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ExhibitionController;
use Illuminate\Support\Facades\Route;
//php use App\Http\Livewire\GoogleMap;


// Route::get('/map', action: \App\Http\Livewire\GoogleMap::class)->name('pages.map');



Route::get('/map', [PageController::class, 'map'])->name('pages.map');
Route::get('/map', [VendorController::class, 'mapPage'])->name('pages.map');



//Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Dashboard Routes
Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//Page Routes
Route::get('/', [PageController::class, 'index'])->name('welcome');
Route::get('/shop', [PageController::class, 'shop'])->name('pages.shop');
Route::get('/exhibition', [PageController::class, 'exhibition'])->name('pages.exhibition');
Route::get('/about', [PageController::class, 'about'])->name(name: 'pages.about');
Route::get('/product-display', [PageController::class, 'productView'])->name('pages.product-overview');
Route::get('/cart', [PageController::class, 'cartview'])->name('pages.cart');
Route::get('/checkout', [PageController::class, 'checkoutview'])->name('pages.checkout');

//Exhibition Routes
Route::middleware(['auth'])->group(function () {
    // redirect to the correct layout
    Route::get('/preview', [ExhibitionController::class, 'preview'])->name('preview');
    Route::post('/preview', [ExhibitionController::class, 'preview'])->name('preview.post');
});
Route::get('/exhibition/{id}', [ExhibitionController::class, 'exhibitionShow'])->name('exhibition.show');
Route::get('/exhibition/vendor/register/{id}', [ExhibitionController::class, 'vendorRegisterExhibitionView'])->name('exhibition.vendor.register');
Route::post('/exhibition/vendor/register', [ExhibitionController::class, 'vendorExhibitionRegisterStore'])->name('exhibition.vendor.register.store');
Route::post('/checkout/payment', [ExhibitionController::class, 'createPaymentIntent'])->name('checkout.payment');
Route::post('/checkout/payment-success', [ExhibitionController::class, 'handlePaymentSuccess'])->name('checkout.payment-success');

//Exhibition preview Routes
Route::get('/preview', function () {
    return view('exhibition.previews.preview');
})->name('preview');
Route::get('/preview/layout1', function () {
    return view('exhibition.previews.layout1');
})->name('preview.layout1');

Route::get('/preview/layout2', function () {
    return view('exhibition.previews.layout2');
})->name('preview.layout2');

Route::get('/preview/layout3', function () {
    return view('exhibition.previews.layout3');
})->name('preview.layout3');

// Admin Routes
Route::middleware('auth')->group(function () {
    //Admin Routes
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');

    //Category Routes
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::post('/admin/users/{user}/deactivate', [AdminController::class, 'deactivateUser'])->name('admin.users.deactivate');
    Route::post('/admin/users/{user}/activate', [AdminController::class, 'activateUser'])->name('admin.users.activate');
});

// Vendor Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        //Update User Information
        Route::post('/dashboard/updatedUserInformation', [UserController::class, 'update'])->name('user-profile.update');

        //Vendor Routes
        Route::post('/register-vendor', [VendorController::class, 'registerVendor'])->name('vendor.register');
        Route::post('/update-store-details', [VendorController::class, 'updateStoreDetails'])->name('vendor.update');
        Route::get('/create-listing', [ProductController::class, 'index'])->name('product.create');
        Route::post('/store-listing', [ProductController::class, 'store'])->name('product.store');
        Route::get('/vendor/products/edit/{id}', [ProductController::class, 'edit'])->name('vendor.products.edit');
        Route::post('/vendor/products/update/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
        Route::delete('/vendor/products/delete/{id}', [ProductController::class, 'destroy'])->name('vendor.products.delete');

        //Order Routes
        Route::get('/orders/details/{order}', [OrderController::class, 'showVendorOrderDetails'])->name('show.vendor.orders.details');
        Route::put('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::post('/orders/{order}/courier', [OrderController::class, 'saveCourierDetails'])->name('orders.saveCourierDetails');
        Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
        
        //Chat Routes
        Route::get('/vendor/messages', [VendorController::class, 'messages'])->name('vendor.messages');
    });
});
//Exhibition Routes
Route::get('/exhibitions/form', [ExhibitionController::class, 'create'])->name('exhibition.create');
Route::post('/exhibitions', [ExhibitionController::class, 'store'])->name('exhibitions.store');
Route::get('/vendor/exhibition/{id}/edit', [ExhibitionController::class, 'edit'])->name('exhibition.edit');
Route::post('/exhibitions/{id}/payment', [ExhibitionController::class, 'processPayment'])->name('exhibitions.processPayment');

// Customer Routes
Route::middleware(['auth', 'verified'])->group(function () {
    //User Routes
    Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder'])->name('orders.delete');
});

//Product Routes
Route::get('/shop', [ProductController::class, 'showProducts'])->name('pages.shop');
Route::get('/product-display/{id}', [ProductController::class, 'show'])->name('pages.product-display');
Route::get('/product-info/{id}', [ProductController::class, 'show'])->name('pages.product-info');

Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/search-modal', [CategoryController::class, 'showSearchModal'])->name('search-modal');

//Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('pages.cart');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update-all', [CartController::class, 'updateAll'])->name('cart.updateAll');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'Checkout'])->name('pages.checkout');
// Route::post('/delivery/process', [CheckoutController::class, 'Delivery'])->name('delivery.process');

Route::post('/checkout/payment', [CheckoutController::class, 'Payment'])->name('checkout.payment');
Route::post('/delivery/process', [CheckoutController::class, 'saveDeliveryDetails'])->name('delivery.process');
Route::post('/payment/process', [CheckoutController::class, 'Payment'])->name('payment.process');

// Route::post('/checkout/delivery', [CheckoutController::class, 'Delivery'])->name('delivery.process');

// Route::get('/payment/complete', [CheckoutController::class, 'handlePaymentComplete'])->name('payment.complete');


// Payment Routes
// Route::post('/create-payment-intent', [CheckoutController::class, 'createPaymentIntent'])->name('payment.intent');
// Route::get('/payment/complete', [CheckoutController::class, 'handlePaymentComplete'])->name('payment.complete');

Route::get('/payment/success', function () {
    return view('payment.success', ['message' => 'Your payment was successful!']);
})->name('payment.success');
Route::get('/payment/failed', function () {
    return view('payment.failed', ['message' => 'Payment failed. Please try again.']);
})->name('payment.failed');

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);





//test admin middleware (make the function in the controller and the middleware and register it in the kernel)
Route::get('/admintest', [PageController::class, 'admintest'])->middleware('admin', 'auth')->name('testAdmin');

require __DIR__ . '/auth.php';
