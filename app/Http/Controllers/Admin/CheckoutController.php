<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Checkout;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class CheckoutController extends BaseController
{
    protected $page = ['title' => 'Checkout', 'content' => 'checkout'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'name', 'type' => 'text', 'label' => 'Name'],
        ['field' => 'total_cost', 'type' => 'text', 'label' => 'Total Cost'],
        ['field' => 'status', 'type' => 'checkbox', 'label' => 'Status']];
    protected $create = false;
    protected $edit = true;
    protected $delete = true;
    protected $sort = false;
    protected $form_view = 'checkout_form';

    protected function model()
    {
        return new Checkout();
    }

    protected function index()
    {

        $page = $this->page;
        $page['type'] = 'List';

        $list_data = collect($this->list_data);
        $create = $this->create;
        $sort = $this->sort;
        $edit = $this->edit;
        $delete = $this->delete;
        $list_view = $this->list_view;

        $select = $this->listQuery($list_data);

        return view('admin.' . $list_view, compact('list_data', 'page', 'select', 'create', 'edit', 'delete', 'sort'));

    }

    protected function listQuery($list_data)
    {
        $select = $this->model()->select($list_data->pluck('field')->all())->orderBy('id', 'DESC')->get();

        foreach ($select as $r) {
            $r->status = ($r->status == 1) ? 'ยังไม่ได้ชำระ' : ($r->status == 2) ? 'ชำระแล้ว' : 'จัดส่ง';
            $r->total_cost = $r->total_cost . ' บาท';
        }

        return $select;
    }

    protected function formData()
    {
        $status = [1 => 'ยังไม่ได้ชำระ', 2 => 'ชำระแล้ว', 3 => 'จัดส่ง'];
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => true],
            ['field' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => true],
            ['field' => 'address', 'type' => 'textarea', 'label' => 'Address', 'required' => true],
            ['field' => 'total_cost', 'type' => 'text', 'label' => 'Total Cost', 'required' => true],
            ['field' => 'transfer_detail', 'type' => 'textarea', 'label' => 'Transfer Detail', 'required' => true],
            ['field' => 'status', 'type' => 'select', 'label' => 'Status', 'required' => true, 'option' => $status]]);
        return $form_data;
    }

    protected function edit($id)
    {
        $page = $this->page;
        $page['type'] = 'Description';
        $page['subtitle'] = 'Edit ' . $this->page['content'];

        $form_data = $this->formData()->values()->all();
        $form_view = $this->form_view;

        $select = $this->model()->find($id);

        $select->total_cost = $select->total_cost . ' บาท';

        $product_cart = ProductCart::join('sub_categories', 'sub_categories.id', '=', 'product_carts.sub_category_id')
            ->select('product_carts.id as id', 'sub_categories.image', 'pieces', 'title', 'cost')
            ->where('checkout_id', $id)
            ->get();

        return view('admin.' . $form_view, compact('page', 'select', 'form_data', 'gallery', 'galleries', 'product_cart'));
    }

    protected function update(Request $request)
    {
        $data = $request->all();
        $update = $this->updateQuery($data['id'], $data);
        if ($update) {
            return back()->with('success', 'Updated');
        } else {
            return back()->with('failed', 'Failed to Update');
        }
    }
}
