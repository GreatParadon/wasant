<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $categories = Category::select('id', 'title_' . $lang . ' as title', 'desc_' . $lang . ' as desc', 'image')->where('active', 1)->orderBy('seq', 'ASC')->get();
        foreach ($categories as $category) {
            $category->image = filePath('category', $category->image);
        }
        return success(compact('categories'));
    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('lang', 'en');
        $categories = Category::find($id);
        $category_image = filePath('category', 'white_' . $categories['image']);
        $sub_category = SubCategory::select('id', 'title_' . $lang . ' as title', 'desc_' . $lang . ' as desc')->where('category_id', $id)->where('active', 1)->orderBy('title_' . $lang, 'ASC')->get();
        if ($sub_category) {
            return success(compact('category_image', 'sub_category'));
        }
        return error('Failed');
    }

    public function allPlace(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $categories = Category::select('id', 'title_' . $lang . ' as title', 'image', 'marker', 'color')->where('active', 1)->orderBy('seq', 'ASC')->get();
        foreach ($categories as $c) {
            $c->image = filePath('category', $c->image);
            $c->marker = filePath('category', $c->marker);
            $c->sub_category = SubCategory::select('id', 'title_' . $lang . ' as title', 'image', 'desc_' . $lang . ' as desc', 'lat', 'lon')->where('category_id', $c->id)->where('active', 1)->orderBy('seq', 'ASC')->get();
            foreach ($c->sub_category as $cs) {
                if (!$cs->image) {
                    $banner = Banner::where('sub_category_id', $cs->id)->first();
                    if (!$banner) {
                        $cs->image = '';
                    } else {
                        $cs->image = filePath('subcategory', $banner->image);
                    }
                } else {
                    $cs->image = filePath('subcategory', $cs->image);
                }
            }
        }

        if ($categories) {
            return success(compact('categories'));
        }
        return error('Failed');
    }

    public function subCateNoBanner()
    {
        $banner = Banner::select('sub_category_id as id')->groupBy('sub_category_id')->get()->pluck('id')->all();

        return $banner;
//        $sub_category = SubCategory::select('id', 'title_en')->whereNotIn('id' , $banner)->get();
//
//        return $sub_category;

//        Excel::create('subcategorybanner', function($sub_category){
//
//        })->export('csv');
    }
}
