<?php

Route::group(['namespace' => 'Web'], function () {

    Route::post('signup', 'UserWebController@signUp');
    Route::post('signin', 'UserWebController@signIn');

    Route::get('', 'WebController@index');
    Route::get('category/{category_id}', 'WebController@getProductListByCategory');
    Route::get('product/{product_id}', 'WebController@product');
    Route::get('promotion/{promotion_id}', 'WebController@promotion');
    Route::get('contact', 'WebController@contact');

    Route::group(['middleware' => 'user'], function () {

        Route::get('signout', 'UserWebController@signOut');
        Route::get('user', 'UserWebController@getUserInformation');
        Route::post('user', 'UserWebController@updateUserInformation');

        Route::get('cart', 'ProductCartController@cart');
        Route::get('checkout', 'ProductCartController@checkout');
        Route::get('checkout/{id}', 'ProductCartController@checkoutDetail');
        Route::post('checkout/{id}', 'ProductCartController@updateCheckout');
        Route::resource('productcart', 'ProductCartController');
        Route::post('changepieces', 'ProductCartController@changePieces');
        Route::post('checkoutcart', 'ProductCartController@checkoutProductCart');

    });


});

Route::group(['middleware' => 'api', 'prefix' => 'api', 'namespace' => 'Api'], function () {

    Route::resource('category', 'CategoryController');
    Route::resource('subcategory', 'SubCategoryController');
    Route::get('allplace', 'CategoryController@allPlace');

});

Route::auth();

Route::get('admin', 'BaseController@dashboard');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('category/sort', 'CategoryController@sortPage');
    Route::post('category/sort', 'CategoryController@sort');
    Route::resource('category', 'CategoryController');

    Route::get('subcategory/sort', 'SubCategoryController@sortPage');
    Route::post('subcategory/sort', 'SubCategoryController@sort');
    Route::resource('subcategory', 'SubCategoryController');

    Route::get('promotion/sort', 'PromotionController@sortPage');
    Route::post('promotion/sort', 'PromotionController@sort');
    Route::resource('promotion', 'PromotionController');

    Route::delete('gallery/{id}', 'SubCategoryController@galleryDestroy');
    Route::post('gallery', 'SubCategoryController@galleryUpload');

    Route::resource('checkout', 'CheckoutController');

    Route::resource('webuser', 'WebUserController');

});

Route::post('wysiwyg_upload', 'BaseController@wysiwygUpload');