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
        return view('category.index', ['title' => 'Category', 'action' => 'category', 'parent' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.index', ['title' => 'Category']);
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
        $category = $this->CategorySave($request, $category);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $id,
            'slug' => 'unique:categories,slug,' . $id,
        ]);
    }
    private function CategorySave(Request $request, $category)
    {
        $slug_request = !empty($request->slug) ? $request->slug : $request->title;
        $slug = Str::of($slug_request)->slug('-');
        $category->title = $request->title;
        $category->slug = $slug;
        $category->parent = $request->parent;


        return $category;
    }
}
