<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ProductCategory::all();
        $data = ['None'];
        foreach ($category as $key => $value) {
            $data[$value['id']] = $value['title'];
        }
        return view('admin.product.category.index', ['title' => 'Category', 'action' => 'productcategory', 'parent' => $data, 'data_parent' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $category = new ProductCategory();
        $category = $this->DataSave($request, $category);
        if ($category->save()) {
            return redirect('admin/productcategory')->with('success', 'Category Saved Successfully');
        } else {
            return redirect('admin/productcategory')->with('error', 'Category Failed to Save');
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
        $cur = ProductCategory::find($id);
        $category = ProductCategory::all();
        $data = ['None'];
        $data_parent = ['None'];
        foreach ($category as $key => $value) {
            if ($value['id'] != $id) {
                $data[$value['id']] = $value['title'];
            }
            $data_parent[$value['id']] = $value['title'];
        }
        return view('admin.product.category.index', ['title' => 'Category', 'method' => 'PUT', 'action' => 'productcategory/' . $id, 'parent' => $data, 'data_parent' => $data_parent, 'data' => $cur]);
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
        $category = ProductCategory::find($id);
        $category = $this->DataSave($request, $category);
        if ($category->save()) {
            return redirect('admin/productcategory/' . $id . '/edit')->with('success', 'Category Updated Successfully');
        } else {
            return redirect('admin/productcategory/' . $id . '/edit')->with('error', 'Category Failed to Update');
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
        $category = ProductCategory::find($id);
        if ($category->products()->count()) {
            return redirect('admin/productcategory/')->with('error', 'Cannot Delete Category, Content has Category record');
        }
        if ($category->delete()) {
            return redirect('admin/productcategory/')->with('success', 'Data Category Berhasil dihapus');
        } else {
            return redirect('admin/productcategory/')->with('error', 'Data Category Gagal dihapus');
        }
    }
    public function json()
    {
        $data_category = ProductCategory::all();
        $table = DataTables::of($data_category);
        return $table->make(true);
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
