<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Config;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use stdClass;

class ConfigController extends Controller
{
    public function homepage()
    {
        $data = Config::where('name', 'homepage')->first();
        if (!empty($data->params)) {
            $params = json_decode($data->params, 1);
        } else {
            $params = [];
        }
        $category = Category::all();
        $productCategory = ProductCategory::all();
        return view('config.homepage', ['data' => $params, 'category' => $category, 'productCategory' => $productCategory]);
    }
    public function homepagesave(Request $request)
    {
        $data = Config::where('name', 'homepage')->first();
        if (empty($data)) {
            $data = new Config();
        } else {
            $data_param = json_decode($data->params, 1);
        }
        $data->name = 'homepage';
        $params = [];
        $params['site_title'] = $request->site_title;
        $params['site_description'] = $request->site_description;
        $params['content_slider'] = $request->content_slider;
        $params['product_slide'] = $request->product_slide;
        $params['product_top'] = $request->product_top;
        // dd($data);
        if (!empty($request->logo_image)) {
            if ($request->hasFile('logo_image')) {
                if ($request->file('logo_image')->isValid()) {
                    $image_title =  'logo_image.' . $request->logo_image->extension();
                    $request->logo_image->storeAs('public/images/config', $image_title);
                    $params['logo_image'] = $image_title;
                }
            }
        } else {
            if (!empty($data_param['logo_image'])) {
                $params['logo_image'] = $data_param['logo_image'];
            }
        }
        if (!empty($request->site_icon)) {
            if ($request->hasFile('site_icon')) {
                if ($request->file('site_icon')->isValid()) {
                    $image_title =  'site_icon.' . $request->site_icon->extension();
                    $request->site_icon->storeAs('public/images/config', $image_title);
                    $params['site_icon'] = $image_title;
                }
            }
        } else {
            if (!empty($data_param['site_icon'])) {
                $params['site_icon'] = $data_param['site_icon'];
            }
        }
        $data->params = json_encode($params);
        if ($data->save()) {
            return redirect('admin/config/homepage/')->with('success', 'Config Updated Successfully');
        } else {
            return redirect('admin/config/homepage/')->with('error', 'Config Updated Failed');
        }
    }
}
