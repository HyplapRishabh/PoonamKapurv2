<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\webController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;

// crown job routes
Route::get('generateSubsKt', [AdminController::class, 'dailySubscriptionKt']);

Route::get('logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/login', [AdminController::class, 'login']);
Route::post('auth', [AdminController::class, 'checkUser'])->name('auth');

Route::get('register', [AdminController::class, 'showRegister']);
Route::post('register', [AdminController::class, 'Register']);

Route::post('/signup', [AdminController::class, 'storeEnquiry']);

Route::get('forgetPassword', [AdminController::class, 'showforget']);
Route::post('forgetPassword', [AdminController::class, 'forgetpassword']);
Route::post('changePassword', [AdminController::class, 'changepassword']);

Route::group(['middleware' => 'checkUserr'], function () {

    Route::get('resetP', [AdminController::class, 'resetPassIndex']);
    Route::post('resetPass', [AdminController::class, 'resetPass']);
    Route::post('checkPhone', [AdminController::class, 'checkPhone']);
    Route::post('checkPass', [AdminController::class, 'checkPass']);


    Route::get('dashboard', [AdminController::class, 'indexAdmin']);

    //Office User 
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [AdminController::class, 'indexUser']);
        Route::post('/addUser', [AdminController::class, 'saveUser']);
        Route::post('/checkEmail', [AdminController::class, 'checkOfficeUserEmail']);
        Route::post('/checkPhone', [AdminController::class, 'checkOfficeUserPhone']);
        Route::get('/exportUserExcel', [AdminController::class, 'exportOfficeUserData']);
        Route::get('/exportToCSV', [AdminController::class, 'exportToCSV']);
        //not working
        //Route::get('/exportToPDF', [AdminController::class, 'exportToPDF']);
        Route::post('/addUserExcel', [AdminController::class, 'saveUserExcel']);
        Route::post('/deleteUser', [AdminController::class, 'deleteUser']);
        Route::post('/updateUser', [AdminController::class, 'updateUser']);
        Route::get('/status', [AdminController::class, 'userStatus']);
    });

    // enduser enduser/checkPhone
    Route::group([
        'prefix' => 'enduser',
    ], function () {
        Route::get('/', [AdminController::class, 'indexEndUser']);
        Route::post('/addEndUser', [AdminController::class, 'saveEndUser']);
        Route::post('/checkEmail', [AdminController::class, 'checkEndUserEmail']);
        Route::post('/checkPhone', [AdminController::class, 'checkEndUserPhone']);
        Route::get('/exportEndUserExcel', [AdminController::class, 'exportEndUserData']);
        Route::post('/addEndUserExcel', [AdminController::class, 'saveEndUserExcel']);
        Route::post('/deleteEndUser', [AdminController::class, 'deleteEndUser']);
        Route::post('/updateEndUser', [AdminController::class, 'updateEndUser']);
        Route::get('/review', [AdminController::class, 'indexReview']);
        Route::post('/review/deleteReviews', [AdminController::class, 'deleteReview']);
        Route::get('/review/status', [AdminController::class, 'reviewStatus']);
    });

    //Role
    Route::group([
        'prefix' => 'role'
    ], function () {
        Route::get('/', [AdminController::class, 'indexRole']);
        Route::post('/addRole', [AdminController::class, 'storeRole']);
        Route::post('/deleteRole', [AdminController::class, 'deleteRole']);
        Route::post('/updateRole', [AdminController::class, 'updateRole']);
    });

    //category
    Route::group([
        'prefix' => 'category'
    ], function () {
        Route::get('/', [AdminController::class, 'indexCategory']);
        Route::post('/addCategory', [AdminController::class, 'storeCategory']);
        Route::post('/deleteCategory', [AdminController::class, 'deleteCategory']);
        Route::post('/updateCategory', [AdminController::class, 'updateCategory']);
        Route::get('/status', [AdminController::class, 'categoryStatus']);
    });

    //subcategory
    Route::group([
        'prefix' => 'subcategory'
    ], function () {
        Route::get('/', [AdminController::class, 'indexSubCategory']);
        Route::post('/addSubCategory', [AdminController::class, 'storeSubCategory']);
        Route::post('/deleteSubCategory', [AdminController::class, 'deleteSubCategory']);
        Route::post('/updateSubCategory', [AdminController::class, 'updateSubCategory']);
        Route::get('/status', [AdminController::class, 'subCategoryStatus']);
    });

    // mealtype
    Route::group([
        'prefix' => 'mealtype'
    ], function () {
        Route::get('/', [AdminController::class, 'indexMealType']);
        Route::post('/addMealType', [AdminController::class, 'storeMealType']);
        Route::post('/deleteMealType', [AdminController::class, 'deleteMealType']);
        Route::post('/updateMealType', [AdminController::class, 'updateMealType']);
        Route::get('/status', [AdminController::class, 'mealTypeStatus']);
    });

    //goal
    Route::group([
        'prefix' => 'goal'
    ], function () {
        Route::get('/', [AdminController::class, 'indexGoal']);
        Route::get('/checkName', [AdminController::class, 'checkGoalName']);
        Route::post('/addGoal', [AdminController::class, 'storeGoal']);
        Route::post('/deleteGoal', [AdminController::class, 'deleteGoal']);
        Route::post('/updateGoal', [AdminController::class, 'updateGoal']);
        Route::get('/status', [AdminController::class, 'goalStatus']);
    });

    //goal
    Route::group([
        'prefix' => 'rawmaterial'
    ], function () {
        Route::get('/', [AdminController::class, 'indexRawMaterial']);
        // Route::get('/checkName', [AdminController::class, 'checkGoalName']);
        Route::post('/add', [AdminController::class, 'storeRawMaterial']);
        Route::post('/delete', [AdminController::class, 'deleteRawMaterial']);
        Route::post('/update', [AdminController::class, 'updateRawMaterial']);
        Route::post('/import', [AdminController::class, 'importRawMaterial']);
    });

    // product
    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get('/', [AdminController::class, 'indexProduct']);
        Route::get('/addProduct', [AdminController::class, 'indexAddProduct']);
        Route::post('/checkUID', [AdminController::class, 'checkPUID']);
        Route::post('/addProduct', [AdminController::class, 'storeProduct']);
        Route::post('/importProduct', [AdminController::class, 'importProduct']);
        Route::post('/importProductMacro', [AdminController::class, 'importProductMacro']);
        Route::post('/importProductRecipe', [AdminController::class, 'importProductRecipe']);
        Route::post('/deleteProduct', [AdminController::class, 'deleteProduct']);
        Route::get('/updateProduct/{uid}', [AdminController::class, 'indexUpdateProduct']);
        Route::post('/updateProduct', [AdminController::class, 'updateProduct']);
        Route::post('/addRecipe', [AdminController::class, 'addRecipe']);
        Route::get('/updateRecipe/{id}', [AdminController::class, 'updateRecipe']);
        Route::get('/deleteRecipe/{id}', [AdminController::class, 'deleteRecipe']);
        Route::get('/status', [AdminController::class, 'productStatus']);
        Route::get('/exportProductExcel', [AdminController::class, 'exportProductData']);
        Route::post('/addProductExcel', [AdminController::class, 'saveProductExcel']);
    });

    // addon
    Route::group([
        'prefix' => 'addon'
    ], function () {
        Route::get('/', [AdminController::class, 'indexAddon']);
        Route::get('/checkUID', [AdminController::class, 'checkUID']);
        Route::post('/addAddon', [AdminController::class, 'storeAddon']);
        Route::post('/deleteAddon', [AdminController::class, 'deleteAddon']);
        Route::post('/updateAddon', [AdminController::class, 'updateAddon']);
        Route::post('/importAddon', [AdminController::class, 'importAddon']);
    });

    // package
    Route::group([
        'prefix' => 'package'
    ], function () {
        Route::get('/', [AdminController::class, 'indexPackage']);
        Route::get('/packageMenu/{uid}', [AdminController::class, 'indexPackageMenu']);
        Route::post('/checkUID', [AdminController::class, 'checkPackUID']);
        Route::post('/importPackage', [AdminController::class, 'importPackage']);
        Route::get('/exportToExcel', [AdminController::class, 'exportPackage']);
        Route::get('/indexAddPackage', [AdminController::class, 'indexAddPackage']);
        Route::post('/addPackage', [AdminController::class, 'storePackage']);
        Route::post('/deletePackage', [AdminController::class, 'deletePackage']);
        Route::get('/indexUpdatePackage/{id}', [AdminController::class, 'indexUpdatePackage']);
        Route::post('/updatePackage', [AdminController::class, 'updatePackage']);
        Route::get('/packageMenu/{uid}/exportToExcel', [AdminController::class, 'exportPackageMenuData']);
        Route::post('/packageMenu/importMultiplePackageMenu', [AdminController::class, 'importMultiplePackageMenu']);
        Route::get('/status', [AdminController::class, 'packageStatus']);
    });

    // pincode
    Route::group([
        'prefix' => 'pincode'
    ], function () {
        Route::get('/', [AdminController::class, 'indexPincode']);
        Route::post('/addPincode', [AdminController::class, 'storePincode']);
        Route::post('/deletePincode', [AdminController::class, 'deletePincode']);
        Route::post('/updatePincode', [AdminController::class, 'updatePincode']);
        Route::get('/status', [AdminController::class, 'pincodeStatus']);
        Route::post('/importPincode', [AdminController::class, 'importPincode']);
    });

    // booking
    Route::group([
        'prefix' => 'booking'
    ], function () {
        Route::get('/', [AdminController::class, 'indexBooking']);
        Route::post('/addBooking', [AdminController::class, 'addBooking']);
        Route::post('/deleteBooking', [AdminController::class, 'deleteBooking']);
        Route::post('/updateBooking', [AdminController::class, 'updateBooking']);
        Route::get('/status', [AdminController::class, 'bookingStatus']);
    });

    // subscription
    Route::group([
        'prefix' => 'subscription'
    ], function () {
        Route::get('/', [AdminController::class, 'indexSubscription']);
        Route::get('/expired', [AdminController::class, 'indexExpiredSubscription']);
        Route::post('/deleteSubscription', [AdminController::class, 'deleteSubscription']);
        Route::post('/updateSubscription', [AdminController::class, 'updateSubscription']);
    });

    // wallet
    Route::group([
        'prefix' => 'wallet'
    ], function () {
        Route::get('/', [AdminController::class, 'indexWallet']);
        Route::post('/update', [AdminController::class, 'updateWallet']);
    });

    // order
    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::get('/', [AdminController::class, 'indexOrder']);
        Route::get('/today', [AdminController::class, 'indexTodayOrder']);
        Route::get('/completed', [AdminController::class, 'indexCompletedOrder']);
        Route::get('/cancelled', [AdminController::class, 'indexCancelledOrder']);
        Route::post('/deleteOrder', [AdminController::class, 'deleteOrder']);
        Route::get('/deleted', [AdminController::class, 'indexDeletedOrder']);
        Route::post('/updateOrder', [AdminController::class, 'updateOrder']);
    });

    // transaction
    Route::group([
        'prefix' => 'transaction'
    ], function () {
        // cart
        Route::get('/cart', [AdminController::class, 'indexCartTransaction']);

        // subscription
        Route::get('/subscription', [AdminController::class, 'indexSubscriptionTransaction']);
    });

    // enquiry
    Route::group([
        'prefix' => 'enquiry'
    ], function () {
        Route::get('/', [AdminController::class, 'indexEnquiry']);
        Route::get('/recent', [AdminController::class, 'indexRecentEnquiry']);
        Route::get('/pending', [AdminController::class, 'indexPendingEnquiry']);
        Route::get('/completed', [AdminController::class, 'indexCompletedEnquiry']);
        Route::get('/notReachable', [AdminController::class, 'indexNotReachableEnquiry']);
        Route::post('/deleteEnquiry', [AdminController::class, 'deleteEnquiry']);
        Route::post('/updateEnquiry', [AdminController::class, 'updateEnquiry']);
    });

    // blog
    Route::group([
        'prefix' => 'blog'
    ], function () {
        Route::get('/', [AdminController::class, 'indexBlog']);
        Route::get('/addBlog', [AdminController::class, 'createBlog']);
        Route::post('/saveBlog', [AdminController::class, 'storeBlog']);
        Route::post('/deleteBlog', [AdminController::class, 'deleteBlog']);
        Route::get('/updateBlog/{slug}', [AdminController::class, 'showBlogUpdate']);
        Route::post('/updateBlog', [AdminController::class, 'updateBlog']);
        Route::get('/status', [AdminController::class, 'blogStatus']);
    });

    //Testimonial
    Route::group([
        'prefix' => 'testimonial'
    ], function () {
        Route::get('/', [AdminController::class, 'indexTestimonial']);
        Route::post('/addTestimonial', [AdminController::class, 'storeTestimonial']);
        Route::post('/updateTestimonial', [AdminController::class, 'updateTestimonial']);
        Route::post('/deleteTestimonial', [AdminController::class, 'deleteTestimonial']);
    });

    // coupons
    Route::group([
        'prefix' => 'coupon'
    ], function () {
        Route::get('/', [AdminController::class, 'indexCoupon']);
        Route::post('/addCoupon', [AdminController::class, 'storeCoupon']);
        Route::post('/updateCoupon', [AdminController::class, 'updateCoupon']);
        Route::post('/deleteCoupon', [AdminController::class, 'deleteCoupon']);
        Route::get('/status', [AdminController::class, 'couponStatus']);
    });

    // faqs
    Route::group([
        'prefix' => 'faqs'
    ], function () {
        Route::get('/', [AdminController::class, 'indexFaq']);
        Route::post('/addFaqs', [AdminController::class, 'storeFaq']);
        Route::post('/updateFaqs', [AdminController::class, 'updateFaq']);
        Route::post('/deleteFaqs', [AdminController::class, 'deleteFaq']);
        // Route::get('/status', [AdminController::class, 'faqStatus']);
    });

    // orders
    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::post('/status', [AdminController::class, 'updateTrxStatus']);
        Route::group([
            'prefix' => 'alacart'
        ], function () {
            Route::get('/', [AdminController::class, 'indexAlacartOrder']);
            Route::get('/today', [AdminController::class, 'indexTodayAlacartOrder']);
            Route::get('/completed', [AdminController::class, 'indexCompletedAlacartOrder']);
            Route::post('/cancel', [AdminController::class, 'cancelAlacartOrder']);
            Route::post('/delete', [AdminController::class, 'deleteAlacartOrder']);
            Route::post('/update', [AdminController::class, 'updateAlacartOrder']);
        });
        Route::group([
            'prefix' => 'package'
        ], function () {
            Route::get('/', [AdminController::class, 'indexPackageOrder']);
            Route::get('/today', [AdminController::class, 'indexTodayPackageOrder']);
            Route::get('/completed', [AdminController::class, 'indexCompletedPackageOrder']);
            Route::post('/status', [AdminController::class, 'statusPackageOrder']);
            Route::post('/delete', [AdminController::class, 'deletePackageOrder']);
            Route::post('/update', [AdminController::class, 'updatePackageOrder']);
        });
    });
});



//webcontroller

Route::get('/', [webController::class, 'welcomeindex']);

Route::group([
    'prefix' => 'app'
], function () {
    Route::get('/allcategory', [webController::class, 'allcategory']);
    Route::get('/category/{catslug}', [webController::class, 'categorydetail']);
    Route::get('/aboutus', [webController::class, 'aboutus']);
    Route::get('/Franchisee', [webController::class, 'Franchisee']); //
    Route::get('/contact-us', [webController::class, 'contactus']);
    Route::get('/privacy-policy', [webController::class, 'privacypolicy']);
    Route::get('/terms-of-service', [webController::class, 'termsofservice']);
    Route::get('/login', [webController::class, 'login']);
    Route::get('/signup', [webController::class, 'signup']);
    Route::get('/resetpassword', [webController::class, 'resetpassword']);
    Route::get('/goal/{goalslug}', [webController::class, 'goaldetail']);
    Route::get('/alltestimonial', [webController::class, 'alltestimonial']); //
    Route::get('/alacart', [webController::class, 'alacart']);
    Route::get('/getproductfilter/{ids}', [webController::class, 'getproductfilter']);
    Route::get('/getgoalpkg/{ids}', [webController::class, 'getgoalpkg']);
    Route::get('/addonlist/{pid}/{mealtype}/{cartid}', [webController::class, 'addonlist']);
    Route::get('/addtocart/{pid}/{addonval}', [webController::class, 'addtocart']);
    Route::post('/checklogin', [webController::class, 'checklogin']);
    Route::post('/checkresetpass', [webController::class, 'checkresetpass']);
    Route::post('/checksignup', [webController::class, 'checksignup']);
    Route::post('/quizsignup', [webController::class, 'quizsignup']);
    Route::post('/signupotp', [webController::class, 'signupotp']);
    Route::get('/getcartdata', [webController::class, 'getcartdata']);
    Route::get('/viewcart', [webController::class, 'viewcart']);
    Route::get('/dish/{productslug}', [webController::class, 'dish']);
    Route::get('/deletefromcart/{cartid}', [webController::class, 'deletefromcart']);
    Route::get('/updatecart/{type}/{cartid}', [webController::class, 'updatecart']);
    Route::get('/packagemenu/{pkgid}', [webController::class, 'packagemenu']);
    Route::get('/packagesubscription/{pkgid}', [webController::class, 'packagesubscription']);
    Route::get('/myprofile', [webController::class, 'myprofile']);
    Route::get('/deletefromcart/{cartid}', [webController::class, 'deletefromcart']);
    Route::get('/weblogout', [webController::class, 'weblogout']);
    Route::get('/consultation', [webController::class, 'consultation']);
    Route::get('/allblogs', [webController::class, 'allblogs']);
    Route::get('/alacartcheckout', [webController::class, 'alacartcheckout']);
    Route::get('/pincodechg/{pincode}', [webController::class, 'pincodechg']);
    Route::post('/alacartorderplace', [webController::class, 'alacartorderplace']);
    Route::post('/subscriptionorderplace', [webController::class, 'subscriptionorderplace']);
    Route::get('/alacartsuccess', [webController::class, 'alacartsuccess']);
    Route::get('/orderdetails', [webController::class, 'orderdetails']);
    Route::get('/deletesubscription/{subid}', [webController::class, 'deletesubscription']);
    Route::post('/gethashofpayu', [webController::class, 'gethashofpayu']);
    Route::post('/undefined', [webController::class, 'undefined']);
    Route::post('/payuresponsepkhk', [webController::class, 'payuresponsepkhk']);
});

