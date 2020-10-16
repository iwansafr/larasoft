<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Menu;
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
        $output_menu = [];
        foreach ($menu as $key) {
            $output_menu[$key->title] = json_decode($key->param, 1);
        }
        $slider = Category::where('slug', 'slider')->first();

        if (!empty($slider->id)) {
            $slider_id = $slider->id;
            $slider_content = Content::whereHas('categories', function (Builder $query) use ($slider_id) {
                $query->where('id', '=', $slider_id);
            })->get();
            $data['slider'] = $slider_content;
        }
        $data['menu'] = $output_menu;
        return $data;
    }
}
