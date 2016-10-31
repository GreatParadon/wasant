<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Promotion;

class PromotionController extends BaseController
{
    protected $page = ['title' => 'Promotion', 'content' => 'promotion'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'title', 'type' => 'text', 'label' => 'Title'],
        ['field' => 'image', 'type' => 'image', 'label' => 'Logo'],
        ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active']];
    protected $create = true;
    protected $edit = true;
    protected $delete = true;
    protected $sort = false;

    protected function model()
    {
        return new Promotion();
    }

//    protected function listQuery($list_data)
//    {
//        return $this->model()->select(
//            'id',
//            'title as title',
//            'title as category_name',
//            'image as image',
//            'active as active')
//            ->orderBy('sub_categories.title', 'ASC')
//            ->paginate(30);
//    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
            ['field' => 'image', 'type' => 'image', 'label' => 'Logo', 'required' => false],
            ['field' => 'content', 'type' => 'wysiwyg', 'label' => 'Content', 'required' => false],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => false]]);

        return $form_data;
    }

}
