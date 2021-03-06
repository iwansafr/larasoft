<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('content/edit', ['title' => 'Add Content', 'action' => 'content', 'categories' => $categories]);
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

        $content = new Content();
        $content = $this->DataSave($request, $content);

        if ($content->save()) {
            $content->categories()->attach($request->categories);
            return redirect('admin/content/create')->with('success', 'Data Content Berhasil diSimpan');
        } else {
            return redirect('admin/content/create')->with('error', 'Data Content Gagal diSimpan');
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
        $content = Content::find($id);
        return view('content.detail', ['data' => $content]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $data = Content::find($id);
        return view('content/edit', ['title' => 'Edit Content', 'action' => 'content/' . $id, 'method' => 'PUT', 'categories' => $categories, 'data' => $data, 'selected' => $data->categories]);
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
        $content = Content::find($id);
        $content = $this->DataSave($request, $content);
        if ($content->save()) {
            $content->categories()->sync($request->categories);
            return redirect('admin/content/' . $id . '/edit')->with('success', 'Content Updated Successfully');
        } else {
            return redirect('admin/content/' . $id . '/edit')->with('error', 'Update Content Failed');
        }
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
        $content = Content::find($id);
        $content->categories()->detach();
        if ($content->delete()) {
            Storage::delete('public/images/content/' . $content->image);
            return redirect('admin/content/')->with('success', 'Deleting Content Success');
        } else {
            return redirect('admin/content/')->with('error', 'Deleting Content Failed');
        }
    }
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:contents,title,' . $id,
            'image' => 'max:1020|mimes:jpeg,png',
            'slug' => 'unique:contents,slug,' . $id,
            'categories' => 'required',
        ]);
    }
    private function DataSave(Request $request, $data)
    {
        $slug_request = !empty($request->slug) ? $request->slug : $request->title;
        $slug = Str::of($slug_request)->slug('-');
        $data->title = $request->title;
        $data->content = $request->content;
        if (empty($request->keyword)) {
            $data->keyword = $request->title;
        }
        if (empty($request->description)) {
            $data->description = $request->title;
        }
        $data->user_id = Auth::user()->id;
        $data->slug = $slug;
        if (!empty($request->image)) {
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $image_title = $slug . '.' . $request->image->extension();
                    $request->image->storeAs('public/images/content', $image_title);
                    $data->image = $image_title;
                }
            }
        } else {
            if (empty($data->id)) {
                $data->image = '';
            }
        }
        return $data;
    }
}
