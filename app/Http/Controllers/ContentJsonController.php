<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContentJsonController extends Controller
{
    public function __invoke()
    {
        $table = DataTables::of(Content::latest());
        return $table->make(true);
    }
}
