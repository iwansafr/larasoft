<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.edit', ['title' => 'Add Product', 'action' => 'product', 'categories' => $categories]);
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

        $product = new Product();
        $product = $this->DataSave($request, $product);

        if ($product->save()) {
            $product->categories()->attach($request->categories);
            return redirect('admin/product/create')->with('success', 'Data Product Berhasil diSimpan');
        } else {
            return redirect('admin/product/create')->with('error', 'Data Product Gagal diSimpan');
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
            'title' => 'required|string|max:255|unique:products,title,' . $id,
            'image' => 'max:1020|mimes:jpeg,png',
            'slug' => 'unique:products,slug,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'categories' => 'required',
        ]);
    }
    private function DataSave(Request $request, $data)
    {
        $slug_request = !empty($request->slug) ? $request->slug : $request->title;
        $slug = Str::of($slug_request)->slug('-');
        $data->title = $request->title;
        $data->price = $request->price;
        $data->stock = $request->stock;
        $data->discount = !empty($request->discount) ? $request->discount : 0;
        $data->description = $request->description;
        $data->publish = !empty($request->publish) ? 1 : 0;
        if (empty($request->keyword)) {
            $data->keyword = $request->title;
        }
        $data->user_id = Auth::user()->id;
        $data->slug = $slug;
        if (!empty($request->image)) {
            dd($request->image);
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $image_title = $slug . '.' . $request->image->extension();
                    $request->image->storeAs('public/images/product', $image_title);
                    $data->image = $image_title;
                }
            }
        } else {
            $data->image = '';
        }
        return $data;
    }
}
