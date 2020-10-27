<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category/customfield', ['title' => 'custom field', 'action' => 'customfield', 'method' => 'POST']);
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
        $data = new CustomField();
        $this->validation($request);
        $data = $this->DataSave($request, $data);
        if ($data->save()) {
            return redirect('admin/customfield')->with('success', 'Custom Field saved Successfully');
        } else {
            return redirect('admin/customfield')->with('error', 'Custom Field saved Failed');
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
        $customfield = CustomField::find($id);
        return view('category/customfield', ['data' => $customfield, 'action' => 'customfield/' . $id, 'method' => 'PUT']);
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
        $customfield = CustomField::find($id);
        $this->validation($request, $id);
        $customfield = $this->DataSave($request, $customfield);
        if ($customfield->save()) {
            return redirect('admin/customfield')->with('success', 'Data Updated Successfully');
        } else {
            return redirect('admin/customfield')->with('error', 'Data Updated Failed');
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
        $customfield = CustomField::find($id);
        if ($customfield->delete()) {
            return redirect('admin/customfield')->with('success', 'Data Deleted Successfully');
        } else {
            return redirect('admin/customfield')->with('error', 'Data Deleted Failed');
        }
    }

    public function json()
    {
        $data = CustomField::all();
        $table = DataTables::of($data);
        return $table->make(true);
    }
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:custom_fields,title,' . $id,
        ]);
    }
    private function DataSave(Request $request, $data)
    {
        $data->title = $request->title;
        return $data;
    }
    public function custom($id)
    {
        $data = CustomField::find($id);
        $type = ['text', 'dropdown', 'radio', 'image'];
        return view('category.customfieldcustom', ['data' => $data, 'type' => $type]);
    }
    public function from($id)
    {
        $data = CustomField::find($id);
        return response()->json($data->param);
    }
    public function updatecustom_field(Request $request)
    {
        $custom_field = CustomField::find($request->id);
        $custom_field->param = $request->param;
        if ($custom_field->save()) {
            return response()->json(['status' => 1, 'msg' => 'custom_field Saved Successfully']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'custom_field Saved Failed']);
        }
    }
}
