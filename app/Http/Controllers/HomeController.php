<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Config;
use App\Models\Content;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index', ['data' => $this->block()]);
    }
    private function block()
    {
        $menu = Menu::all();
        $config_home = Config::where('name', 'homepage')->first();
        $output_menu = [];
        foreach ($menu as $key) {
            $output_menu[$key->title] = json_decode($key->param, 1);
        }
        if (!empty($config_home->params)) {
            $home_config = json_decode($config_home->params);
            $slider_id = $home_config->content_slider;
            $product_top_id = $home_config->product_top;

            if (!empty($slider_id)) {
                $slider_content = Content::whereHas('categories', function (Builder $query) use ($slider_id) {
                    $query->where('id', '=', $slider_id);
                })->get();
                $data['slider'] = $slider_content;
            }
            if (!empty($product_top_id)) {
                $product_top = Product::whereHas('categories', function (Builder $query) use ($product_top_id) {
                    $query->where('id', '=', $product_top_id);
                })->get();
                $data['product_top'] = $product_top;
                $data['product_top_category'] = ProductCategory::find($product_top_id);
            }
        }
        $data['menu'] = $output_menu;
        return $data;
    }
}
