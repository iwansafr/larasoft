<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserJsonController extends Controller
{
    public function __invoke()
    {
        $table = DataTables::of(User::all());
        $table->addColumn('photo', function ($user) {
            if (!empty($user->photo)) {
                $url = asset('storage/images/user/' . $user->photo);
                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
            }
        })->addColumn('action', function ($user) {
            return '<a href="/admin/user/edit/' . $user->id . '" class="btn btn-xs btn-primary" title="edit"><i class="fa fa-edit"></i></a>
                   <a href="/admin/user/destroy/' . $user->id . '" class="btn btn-xs btn-danger" title="hapus"><i class="fa fa-trash"></i></a>   ';
        })->rawColumns(['photo', 'action']);
        return $table->make(true);
    }
}
