<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends BaseController
{
    protected $page = ['title' => 'Category', 'content' => 'category'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'title', 'type' => 'text', 'label' => 'Title'],
        ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active']];
    protected $create = true;
    protected $edit = true;
    protected $delete = true;
    protected $sort = true;

    protected function model()
    {
        return new Category();
    }

    protected function listQuery($list_data)
    {
        return $this->model()->select($list_data->pluck('field')->all())->orderBy('seq', 'ASC')->get();
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => false]]);
        return $form_data;
    }

}
