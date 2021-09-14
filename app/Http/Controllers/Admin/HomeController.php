<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Script;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalScript = Script::count();
        $totalMember = Member::count();
        return view('admin.pages.home.index', compact('totalScript', 'totalMember'));
    }
}
