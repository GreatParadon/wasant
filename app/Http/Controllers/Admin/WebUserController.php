<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ProductCart;
use App\Models\WebUser;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class WebUserController extends BaseController
{
    protected $page = ['title' => 'WebUser', 'content' => 'webuser'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'name', 'type' => 'text', 'label' => 'Name'],
        ['field' => 'tel', 'type' => 'text', 'label' => 'Tel']];
    protected $create = false;
    protected $edit = true;
    protected $delete = true;
    protected $sort = false;

    protected function model()
    {
        return new WebUser();
    }

    protected function listQuery($list_data)
    {
        $select = $this->model()->select($list_data->pluck('field')->all())->orderBy('id', 'DESC')->get();

        return $select;
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => true],
            ['field' => 'email', 'type' => 'text', 'label' => 'Email', 'required' => true],
            ['field' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => true],
            ['field' => 'address', 'type' => 'textarea', 'label' => 'Address', 'required' => true],
            ['field' => 'tel', 'type' => 'text', 'label' => 'Tel', 'required' => true]]);
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

        return view('admin.' . $form_view, compact('page', 'select', 'form_data', 'gallery', 'galleries'));
    }

}
