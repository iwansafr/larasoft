<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function homepage()
    {
        $data = Config::where('name', 'homepage')->first();
        $params = json_decode($data->params, 1);
        return view('config.homepage', ['data' => $params]);
    }
    public function homepagesave(Request $request)
    {
        $data = Config::where('name', 'homepage')->first();
        if (empty($data)) {
            $data = new Config();
        }
        $data->name = 'homepage';
        $params = ['title' => $request->title];
        $data->params = json_encode($params);
        if ($data->save()) {
            return redirect('admin/config/homepage/')->with('success', 'Config Updated Successfully');
        } else {
            return redirect('admin/config/homepage/')->with('error', 'Config Updated Failed');
        }
    }
}
