<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Gear;

class GearController extends BaseController
{
    protected $page = ['title' => 'Gear', 'content' => 'gear'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'title', 'type' => 'text', 'label' => 'Title'],
        ['field' => 'image', 'type' => 'image', 'label' => 'Gear Image'],
        ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active']];
    protected $create = true;
    protected $edit = true;
    protected $delete = true;
    protected $sort = true;

    protected function model()
    {
        return new Gear();
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
            ['field' => 'image', 'type' => 'image', 'label' => 'Gear Image', 'required' => false],
            ['field' => 'content', 'type' => 'wysiwyg', 'label' => 'Content', 'required' => false],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => false]]);

        return $form_data;
    }

}
