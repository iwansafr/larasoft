<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $data['menu'] = $output_menu;
        return $data;
    }
}
