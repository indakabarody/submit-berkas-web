<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalScript = Script::where('member_id', Auth::user()->id)->count();

        return view('member.pages.home.index', compact('totalScript'));
    }
}
