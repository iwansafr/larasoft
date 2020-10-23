<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Config;
use Illuminate\Http\Request;

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
        return view('config.homepage', ['data' => $params, 'category' => $category]);
    }
    public function homepagesave(Request $request)
    {
        $data = Config::where('name', 'homepage')->first();
        if (empty($data)) {
            $data = new Config();
        }
        $slug_request = !empty($request->slug) ? $request->slug : $request->title;
        $slug = Str::of($slug_request)->slug('-');
        $data->name = 'homepage';
        $params = [];
        $params['title'] = $request->title;
        $params['site_title'] = $request->site_title;
        $params['site_description'] = $request->site_description;
        $params['content_slider'] = $request->content_slider;
        $params['product_top'] = $request->product_top;

        if (!empty($request->logo_image)) {
            if ($request->hasFile('logo_image')) {
                if ($request->file('logo_image')->isValid()) {
                    $image_title =  'logo_image.' . $request->logo_image->extension();
                    $request->logo_image->storeAs('public/images/config', $image_title);
                    $params['logo_image'] = $image_title;
                }
            }
        } else {
            if (empty($data->id)) {
                $params['logo_image'] = '';
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
            if (empty($data->id)) {
                $params['site_icon'] = '';
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
