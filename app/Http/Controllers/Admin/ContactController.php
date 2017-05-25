<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Contact;

class ContactController extends BaseController
{
    protected $page = ['title' => 'Contact', 'content' => 'contact'];
    protected $list_data = [
        ['field' => 'id', 'type' => 'number', 'label' => 'ID'],
        ['field' => 'name', 'type' => 'text', 'label' => 'Name'],
        ['field' => 'email', 'type' => 'text', 'label' => 'Email'],
        ['field' => 'tel', 'type' => 'text', 'label' => 'Tel'],
        ['field' => 'topic', 'type' => 'text', 'label' => 'Topic'],
    ];
    protected $create = false;
    protected $edit = true;
    protected $delete = true;
    protected $sort = false;

    protected function model()
    {
        return new Contact();
    }

    protected function formData()
    {
        $form_data = collect([['field' => 'id', 'type' => 'number', 'label' => 'ID', 'required' => false],
            ['field' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => false],
            ['field' => 'email', 'type' => 'text', 'label' => 'Email', 'required' => false],
            ['field' => 'tel', 'type' => 'text', 'label' => 'Tel', 'required' => false],
            ['field' => 'topic', 'type' => 'text', 'label' => 'Topic', 'required' => false],
            ['field' => 'message', 'type' => 'content', 'label' => 'Message', 'required' => false],
        ]);

        return $form_data;
    }

}
