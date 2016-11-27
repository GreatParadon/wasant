<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends BaseController
{
    protected $page = ['title' => 'SubCategory', 'content' => 'subcategory'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'title', 'type' => 'text', 'label' => 'Title'],
        ['field' => 'category_name', 'type' => 'text', 'label' => 'Category'],
        ['field' => 'image', 'type' => 'image', 'label' => 'Logo'],
        ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active']];
    protected $create = true;
    protected $edit = true;
    protected $delete = true;
    protected $gallery = false;
    protected $sort = true;

    protected function model()
    {
        return new SubCategory();
    }

    protected function listQuery($list_data)
    {
        return $this->model()->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.id as id', 'sub_categories.title as title', 'categories.title as category_name', 'sub_categories.image as image', 'sub_categories.active as active')
            ->orderBy('sub_categories.title', 'ASC')
            ->paginate(30);
    }

    protected function formData()
    {
        $categories = Category::select('id', 'title')->get()->pluck('title', 'id');
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
            ['field' => 'image', 'type' => 'image', 'label' => 'Logo', 'required' => false],
            ['field' => 'category_id', 'type' => 'select', 'label' => 'Category', 'option' => $categories],
            ['field' => 'content', 'type' => 'wysiwyg', 'label' => 'Content', 'required' => true],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => true]]);

        return $form_data;
    }

}
