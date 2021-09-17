<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scripts = Script::where('member_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('member.pages.scripts.index', compact('scripts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProcessedScripts()
    {
        $scripts = Script::where('member_id', Auth::user()->id)
                    ->whereNotNull('reviewed_at')
                    ->whereNull('done_reviewed_at')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('member.pages.scripts.index-processed', compact('scripts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDoneProcessedScripts()
    {
        $scripts = Script::where('member_id', Auth::user()->id)
                    ->whereNotNull('reviewed_at')
                    ->whereNotNull('done_reviewed_at')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('member.pages.scripts.index-done', compact('scripts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
