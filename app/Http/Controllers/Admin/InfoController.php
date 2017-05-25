<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Info;

class InfoController extends BaseController
{
    protected $page = ['title' => 'Info', 'content' => 'info'];
    protected $list_data = [['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'image', 'type' => 'image', 'label' => 'Info Image'],
        ['field' => 'title', 'type' => 'text', 'label' => 'Title']];

    protected function model()
    {
        return new Info();
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'image', 'type' => 'image', 'label' => 'Info Image (1165 x 380)', 'required' => false],
            ['field' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => false]]);

        return $form_data;
    }

}
