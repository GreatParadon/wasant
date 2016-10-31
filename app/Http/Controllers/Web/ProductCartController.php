<?php

namespace App\Http\Controllers\Web;

use App\Models\Checkout;
use App\Models\ProductCart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $sub_category_id = $input['sub_category_id'];
        $input['user_id'] = userId($request);
        $input['pieces'] = 1;

        $product_cart = ProductCart::where('sub_category_id', $sub_category_id)->whereNull('checkout_id')->first();
        if (!$product_cart) {
            ProductCart::create($input);
        } else {
            ProductCart::where('sub_category_id', $sub_category_id)->update(['pieces' => $product_cart->pieces + 1]);
        }

        return success('เพิ่มสินค้าเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = ProductCart::destroy($id);

        return ($destroy) ? success('ลบ สินค้าในตระกร้า สำเร็จ') : error('ลบ สินค้าในตระกร้า ไม่สำเร็จ');
    }

    public function totalCost($user_id)
    {
        $product_cart = ProductCart::join('sub_categories', 'sub_categories.id', '=', 'product_carts.sub_category_id')
            ->select('product_carts.id as id', 'pieces', 'cost')
            ->where('user_id', $user_id)
            ->whereNull('checkout_id')
            ->get();

        foreach ($product_cart as $r) {
            $r->total = $r->cost * $r->pieces;
        }

        return $product_cart->sum('total');
    }

    public function cart(Request $request)
    {
        $user_id = userId($request);

        $product_cart = ProductCart::join('sub_categories', 'sub_categories.id', '=', 'product_carts.sub_category_id')
            ->select('product_carts.id as id', 'sub_categories.image', 'pieces', 'title', 'cost')
            ->where('user_id', $user_id)
            ->whereNull('checkout_id')
            ->get();

        foreach ($product_cart as $r) {
            $r->total = $r->cost * $r->pieces;
        }

        $total = $product_cart->sum('total');

        return view('web.cart', compact('product_cart', 'total'));
    }

    public function checkout(Request $request)
    {
        $user_id = userId($request);
        $checkout = Checkout::where('user_id', $user_id)->get();

        return view('web.checkout', compact('checkout'));
    }

    public function checkoutDetail($id)
    {
        $checkout = Checkout::find($id);

        $product_cart = ProductCart::join('sub_categories', 'sub_categories.id', '=', 'product_carts.sub_category_id')
            ->select('product_carts.id as id', 'sub_categories.image', 'pieces', 'title', 'cost')
            ->where('checkout_id', $checkout->id)
            ->get();

        return view('web.checkout_detail', compact('checkout', 'product_cart'));
    }

    public function changePieces(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $user_id = userId($request);
        $pieces = $input['pieces'];

        $select = ProductCart::join('sub_categories', 'sub_categories.id', '=', 'product_carts.sub_category_id')
            ->select('product_carts.id', 'pieces', 'cost')
            ->where('user_id', $user_id)
            ->where('product_carts.id', $id)
            ->whereNull('checkout_id')
            ->first();

        $select->update(['pieces' => $pieces]);

        $total = $this->totalCost($user_id);

        $total_product_cost = $select->cost * $pieces;

        return success(compact('total', 'total_product_cost'));
    }

    public function checkoutProductCart(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = userId($request);
        $input['total_cost'] = $this->totalCost($input['user_id']);
        $input['status'] = 1;

        $isset_product = ProductCart::whereNull('checkout_id')->first();
        if ($isset_product) {
            $checkout = Checkout::create($input);
            $checkout_id = $checkout->id;
            $product_cart = ProductCart::where('user_id', $input['user_id'])->whereNull('checkout_id')->update(['checkout_id' => $checkout_id]);
            $message = 'ยืนยันรายการสินค้าสำเร็จ';
        }

        return (isset($product_cart)) ? success(compact('checkout_id', 'message')) : error('ยืนยันรายการสินค้าไม่สำเร็จ');
    }

    public function updateCheckout(Request $request, $id)
    {
        $input = $request->all();
        $input['status'] = 2;
        $checkout = Checkout::find($id)->update($input);

        return ($checkout) ? success('แจ้งชำระรายการสินค้าสำเร็จ') : error('แจ้งชำระรายการสินค้าไม่สำเร็จ');
    }
}
