<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserJsonController extends Controller
{
    public function __invoke()
    {
        $table = DataTables::of(User::all());
        return $table->make(true);
    }
}
