<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;

use App\Http\Requests;
use App\Models\ProductCart;
use App\Models\Promotion;
use App\Models\SubCategory;
use App\Models\WebUser;
use Illuminate\Http\Request;


class WebController extends Controller
{

    private static function categoryList()
    {
        $categories = Category::where('active', 1)->get();
        return $categories;
    }

    public function index()
    {
        $categories = $this->categoryList();
        $title = true;
        $promotions = Promotion::where('active', 1)->orderBy('updated_at', 'ASC')->get();
        $information = 'ร้าน ตติระ สำหรับคนท่ีอยากจะมาดู แบบสินค้าด้วยตนเอง ร้านจะอยู่ ในซอย 1 ถนน นิมมานเหมินทร์ ร้านอยู่ ทางซ้ายมือ';

        return view('web.index', compact('categories', 'title', 'promotions', 'information'));
    }

    public function getProductListByCategory($category_id)
    {
        if ($category_id) {
            $categories = $this->categoryList();
            $products = SubCategory::where('category_id', $category_id)->where('active', 1)->get();
            $category = Category::find($category_id);
            $name = $category->title;
            $desc = $category->desc;
            return view('web.product_list', compact('categories', 'name', 'products', 'desc'));
        } else {
            return $this->index();
        }
    }

    public function product($product_id)
    {
        if ($product_id) {
            $categories = $this->categoryList();
            $product = SubCategory::where('id', $product_id)->where('active', 1)->first();
            $gallery = Banner::where('sub_category_id', $product->id)->get();
            return view('web.product', compact('categories', 'product', 'gallery'));
        } else {
            return $this->index();
        }
    }

    public function promotion($promotion_id)
    {
        if ($promotion_id) {
            $categories = $this->categoryList();
            $promotion = Promotion::select('promotions.*')
                ->where('promotions.id', $promotion_id)->where('promotions.active', 1)->first();
            return view('web.promotion', compact('categories', 'promotion'));
        } else {
            return $this->index();
        }
    }

    public function contact()
    {
        $categories = $this->categoryList();
        return view('web.contact', compact('categories'));
    }

}
