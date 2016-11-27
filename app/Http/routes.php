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

    Route::get('service', function () {
        $service = \App\Models\Category::select('id', 'title')->where('active', 1)->get();
        foreach ($service as $r) {
//            $r->service_image = '2';
//            $service_image = \App\Models\SubCategory::select('image')->where('category_id', $r->id)->where('active', 1)->get()->pluck('image');
            $r->service_image = \App\Models\SubCategory::select('image')->where('category_id', $r->id)->where('active', 1)->get();
        }

//        dd($service);

        return view('web.service', compact('service'));
    });

    Route::get('{web}', function ($web) {
        return view('web.' . $web);
    });
});