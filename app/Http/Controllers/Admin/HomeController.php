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
        $totalMemberWriter = Member::where('is_writer', 1)->count();
        $totalMemberTraining = Member::where('is_training', 1)->count();
        $totalMemberInternship = Member::where('is_internship', 1)->count();

        return view('admin.pages.home.index', compact('totalScript', 'totalMember',
                        'totalMemberWriter', 'totalMemberTraining', 'totalMemberInternship'));
    }
}
