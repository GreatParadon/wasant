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
        ['field' => 'image', 'type' => 'image', 'label' => 'Image'],
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
            ['field' => 'desc', 'type' => 'text', 'label' => 'Description', 'required' => true],
            ['field' => 'image', 'type' => 'image', 'label' => 'Image', 'required' => false],
            ['field' => 'active', 'type' => 'checkbox', 'label' => 'Active', 'required' => false]]);
        return $form_data;
    }

    protected function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['active'])) {
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }

        $image = $this->formData()->where('type', 'image')->pluck('field')->all();

        foreach ($image as $r) {
            $file = $request->file($r);

            if ($file) {
                $image = fileUpload($file, $this->page['content']);
                if ($image['success'] == true) {
                    $data[$r] = $image['filename'];
                    Image::make($file)->limitColors(255, '#ffffff')->colorize(100, 100, 100)->save(public_path('content/'.$this->page['content'].'/white_' . $data[$r]));
                } else {
                    return back()->with('failed', 'Failed to Store');
                }
            }
        }

        $create = $this->storeQuery($data);
        if ($create) {
            return redirect('admin/' . $this->page['content'] . '/' . $create->id . '/edit')->with('success', 'Stored');
        } else {
            return back()->with('failed', 'Failed to Store');
        }
    }

    protected function update(Request $request)
    {
        $data = $request->all();

        if (isset($data['active'])) {
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }

        $image = $this->formData()->where('type', 'image')->pluck('field')->all();

        foreach ($image as $r) {
            $file = $request->file($r);

            if ($file) {
                $image = fileUpload($file, $this->page['content']);
                if ($image['success'] == true) {
                    $data[$r] = $image['filename'];
                    Image::make($file)->limitColors(255, '#ffffff')->colorize(100, 100, 100)->save(public_path('content/'.$this->page['content'].'/white_' . $data[$r]));
                } else {
                    return back()->with('failed', 'Failed to Store');
                }
            }
        }

        $update = $this->updateQuery($data['id'], $data);
        if ($update) {
            return back()->with('success', 'Updated');
        } else {
            return back()->with('failed', 'Failed to Update');
        }
    }
}
