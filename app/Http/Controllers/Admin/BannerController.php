<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Banner;

class BannerController extends BaseController
{
    protected $page = ['title' => 'Banner', 'content' => 'banner'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'image', 'type' => 'image', 'label' => 'Banner Image'],
        ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active']];
    protected $create = true;
    protected $edit = true;
    protected $delete = true;
    protected $sort = true;

    protected function model()
    {
        return new Banner();
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'image', 'type' => 'image', 'label' => 'Banner Image (1280 x 500)', 'required' => false],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => false]]);

        return $form_data;
    }

}
