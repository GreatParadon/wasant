<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $page = [];
    protected $list_data = [];
    protected $create = false;
    protected $edit = false;
    protected $delete = false;
    protected $sort = false;
    protected $gallery = false;
    protected $list_view = 'list';
    protected $form_view = 'form';

    protected function model()
    {
        return new Test();
    }

    protected function formData()
    {
        $form_data = collect([]);
        return new $form_data;
    }

    protected function galleryQuery($id)
    {
        return new Test();
    }

    protected function listQuery($list_data)
    {
        return $this->model()->select($list_data->pluck('field')->all())->get();
    }

    protected function storeQuery($data)
    {
        return $this->model()->create($data);
    }

    protected function updateQuery($id, $data)
    {
        return $this->model()->find($id)->update($data);
    }

    protected function destroyQuery($id)
    {
        return $this->model()->destroy($id);
    }

    protected function dashboard()
    {
        return view('layouts.app', ['page' => ['title' => 'Dashboard']]);
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

        foreach ($select as $r) {
            foreach ($list_data->values() as $l) {
                if ($l['type'] == 'image') {
                    if (!$r->{$l['field']}) {
                        $r->{$l['field']} = 'No Image';
                    } else {
                        $r->{$l['field']} = '<a href="' . filePath($this->page['content'], $r->{$l['field']}) . '" data-lightbox="' . $l['field'] . '">
                        <img src="' . filePath($this->page['content'], $r->{$l['field']}) . '" width="50">
                        </a>';
                    }
                }

                if ($l['type'] == 'checkbox') {
                    if ($r->{$l['field']} == 1) {
                        $r->{$l['field']} = '<span class="label label-success">' . $l['label'] . '</span>';
                    } else {
                        $r->{$l['field']} = '<span class="label label-danger">' . $l['label'] . '</span>';
                    }
                }
            }
        }

        return view('admin.' . $list_view, compact('list_data', 'page', 'select', 'create', 'edit', 'delete', 'sort'));
    }

    protected function create()
    {
        $page = $this->page;
        $page['type'] = 'Description';
        $page['subtitle'] = 'Create new ' . $this->page['content'];

        $form_data = $this->formData();
        $form_view = $this->form_view;

        return view('admin.' . $form_view, compact('page', 'form_data'));
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

    protected function show($id)
    {
        $select = $this->model()->find($id);
        if ($select) {
            return success(compact('select'));
        } else {
            return error('Failed to load data');
        }
    }

    protected function edit($id)
    {
        $page = $this->page;
        $page['type'] = 'Description';
        $page['subtitle'] = 'Edit ' . $this->page['content'];

        $gallery = $this->gallery;
        if ($gallery == true) {
            $galleries = $this->galleryQuery($id);
        }
        $form_data = $this->formData()->values()->all();
        $form_view = $this->form_view;

        $select = $this->model()->find($id);

        return view('admin.' . $form_view, compact('page', 'select', 'form_data', 'gallery', 'galleries'));
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

    protected function destroy($id)
    {
        $delete = $this->destroyQuery($id);
        if ($delete) {
            return success('Deleted');
        } else {
            return error('Failed to Delete');
        }
    }

    protected function wysiwygUpload(Request $request)
    {
        $file = $request->file('file');
        $uploadPath = 'wysiwyg';
        $file_upload = fileUpload($file, $uploadPath);
        if ($file_upload['success'] == true) {
            return success(['filepath' => filePath('wysiwyg', $file_upload['filename'])]);
        }
        return error($file_upload['message']);
    }

    protected function sortPage()
    {
        $page = $this->page;
        $page['type'] = 'Sort';

        $list_data = collect($this->list_data);

        $select = $this->listQuery($list_data);

        foreach ($select as $r) {
            foreach ($list_data->values() as $l) {
                if ($l['type'] == 'image') {
                    $r->{$l['field']} = '<a href="' . filePath($this->page['content'], $r->{$l['field']}) . '" data-lightbox="' . $l['field'] . '">
                        <img src="' . filePath($this->page['content'], $r->{$l['field']}) . '" width="20">
                        </a>';
                }

                if ($l['type'] == 'checkbox') {
                    if ($r->{$l['field']} == 1) {
                        $r->{$l['field']} = '<span class="label label-success">' . $l['label'] . '</span>';
                    } else {
                        $r->{$l['field']} = '<span class="label label-danger">' . $l['label'] . '</span>';
                    }
                }
            }
        }
        return view('admin.sort', compact('list_data', 'page', 'select'));
    }

    protected function sort(Request $request)
    {
        $data = $request->input('data');
//        dd($data);
        $seq = 0;

        foreach ($data as $r) {
            $this->model()->where('id', $r)->update(['seq' => $seq]);
            $seq++;
        }

        return success(['message' => 'Succeed']);
    }

}
