<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides = Guide::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
        ]);

        Guide::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.guides.index')->with('toast_success', 'Berhasil menambahkan panduan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guide = Guide::findOrFail($id);
        return view('admin.pages.guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guide = Guide::findOrFail($id);
        return view('admin.pages.guides.edit', compact('guide'));
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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
        ]);

        Guide::findOrFail($id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.guides.index')->with('toast_success', 'Berhasil menyimpan panduan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guide::findOrFail($id)->delete();
        return redirect()->route('admin.guides.index')->with('toast_success', 'Berhasil menghapus panduan');
    }
}
