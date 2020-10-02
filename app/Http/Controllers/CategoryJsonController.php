<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryJsonController extends Controller
{
    public function __invoke()
    {
        $data_category = Category::all();
        $table = DataTables::of($data_category);
        return $table->make(true);
    }
}
