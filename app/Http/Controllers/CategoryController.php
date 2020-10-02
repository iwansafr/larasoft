<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $data = ['None'];
        foreach ($category as $key => $value) {
            $data[$value['id']] = $value['title'];
        }
        return view('category.index', ['title' => 'Category', 'action' => 'category', 'parent' => $data, 'data_parent' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $category = new Category();
        $category = $this->DataSave($request, $category);
        if ($category->save()) {
            return redirect('admin/category')->with('success', 'Category Saved Successfully');
        } else {
            return redirect('admin/category')->with('error', 'Category Failed to Save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cur = Category::find($id);
        $category = Category::all();
        $data = ['None'];
        $data_parent = ['None'];
        foreach ($category as $key => $value) {
            if ($value['id'] != $id) {
                $data[$value['id']] = $value['title'];
            }
            $data_parent[$value['id']] = $value['title'];
        }
        return view('category.index', ['title' => 'Category', 'method' => 'PUT', 'action' => 'category/' . $id, 'parent' => $data, 'data_parent' => $data_parent, 'data' => $cur]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validation($request, $id);
        $category = Category::find($id);
        $category = $this->DataSave($request, $category);
        if ($category->save()) {
            return redirect('admin/category/' . $id . '/edit')->with('success', 'Category Updated Successfully');
        } else {
            return redirect('admin/category/' . $id . '/edit')->with('error', 'Category Failed to Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->content()->count()) {
            return redirect('admin/category/')->with('error', 'Cannot Delete Category, Content has Category record');
        }
        if ($category->delete()) {
            return redirect('admin/category/')->with('success', 'Data Category Berhasil dihapus');
        } else {
            return redirect('admin/category/')->with('error', 'Data Category Gagal dihapus');
        }
    }
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $id,
            'slug' => 'unique:categories,slug,' . $id,
        ]);
    }
    private function DataSave(Request $request, $data)
    {
        $slug_request = !empty($request->slug) ? $request->slug : $request->title;
        $slug = Str::of($slug_request)->slug('-');
        $data->title = $request->title;
        $data->slug = $slug;
        $data->parent = $request->parent;


        return $data;
    }
}
