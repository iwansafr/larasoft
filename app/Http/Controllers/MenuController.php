<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu/index', ['title' => 'Menu', 'action' => 'menu', 'method' => 'POST']);
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
        $data = new Menu();
        $this->validation($request);
        $data = $this->DataSave($request, $data);
        if ($data->save()) {
            return redirect('admin/menu')->with('success', 'Menu saved Successfully');
        } else {
            return redirect('admin/menu')->with('error', 'Menu saved Failed');
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
        $menu = Menu::find($id);
        return view('menu/index', ['data' => $menu, 'action' => 'menu/' . $id, 'method' => 'PUT']);
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
        $menu = Menu::find($id);
        $this->validation($request, $id);
        $menu = $this->DataSave($request, $menu);
        if ($menu->save()) {
            return redirect('admin/menu')->with('success', 'Data Updated Successfully');
        } else {
            return redirect('admin/menu')->with('error', 'Data Updated Failed');
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
        $menu = Menu::find($id);
        if ($menu->delete()) {
            return redirect('admin/menu')->with('success', 'Data Deleted Successfully');
        } else {
            return redirect('admin/menu')->with('error', 'Data Deleted Failed');
        }
    }

    public function json()
    {
        $data = Menu::all();
        $table = DataTables::of($data);
        return $table->make(true);
    }
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:menus,title,' . $id,
        ]);
    }
    private function DataSave(Request $request, $data)
    {
        $data->title = $request->title;
        return $data;
    }
    public function custom($id)
    {
        $data = Menu::find($id);
        return view('menu.custom', ['data' => $data]);
    }
    public function from($id)
    {
        $data = Menu::find($id);
        return response()->json($data->param);
    }
    public function updatemenu(Request $request)
    {
        $menu = Menu::find($request->id);
        $menu->param = $request->param;
        if ($menu->save()) {
            return response()->json(['status' => 1, 'msg' => 'Menu Saved Successfully']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Menu Saved Failed']);
        }
    }
}
