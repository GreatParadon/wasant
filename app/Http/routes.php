<?php

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


Route::group(['namespace' => 'Web'], function () {
    Route::get('', function () {
        $promotion = \App\Models\Promotion::where('active', 1)->get();

        return view('web.index', compact('promotion'));
    });

    Route::get('{web}', function ($web) {
        return view('web.' . $web);
    });
});