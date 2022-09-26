<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $user_id = auth()->id();
        $users = DB::table('users')->where('id', '<>', $user_id)->get();
        return view('admin.index', ['users' => $users]);
    }
}
