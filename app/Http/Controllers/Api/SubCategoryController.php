<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{

    public function show(Request $request, $id)
    {
        $lang = $request->header('lang', 'en');
        $sub_category = SubCategory::select('id', 'category_id', 'title_' . $lang . ' as title', 'desc_' . $lang . ' as desc', 'url as share_url', 'image', 'content_' . $lang . ' as content', 'lat', 'lon')
            ->where('id', $id)
            ->where('active', 1)
            ->orderBy('seq', 'ASC')
            ->first();

        $banner = Banner::select('image')
            ->where('sub_category_id', $sub_category->id)
            ->get();

        $sub_category->image = filePath('subcategory', $sub_category->image);

        $category_image = Category::select('image')
            ->where('id', $sub_category->category_id)->first();

        $sub_category->category_image = filePath('category', $category_image->image);;
        foreach ($banner as $g) {
            $g->image = filePath('subcategory', $g->image);
        }
        $sub_category->banner = $banner->pluck('image')->all();

        if ($sub_category) {
            return success(compact('sub_category'));
        }
        return error('Failed');
    }

}
