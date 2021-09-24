<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AllScriptExport;
use App\Exports\DoneProcessedScriptExport;
use App\Exports\ProcessedScriptExport;
use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scripts = Script::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.scripts.index', compact('scripts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProcessedScripts()
    {
        $scripts = Script::whereNotNull('reviewed_at')
                    ->whereNull('done_reviewed_at')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('admin.pages.scripts.index-processed', compact('scripts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDoneProcessedScripts()
    {
        $scripts = Script::whereNotNull('reviewed_at')
                    ->whereNotNull('done_reviewed_at')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('admin.pages.scripts.index-done', compact('scripts'));
    }

    public function exportExcelAllScripts()
    {
        return Excel::download(new AllScriptExport, 'all_scripts_'.date('YmdHis').'.xlsx');
    }

    public function exportExcelProcessedScripts()
    {
        return Excel::download(new ProcessedScriptExport, 'processed_scripts_'.date('YmdHis').'.xlsx');
    }

    public function exportExcelDoneProcessedScripts()
    {
        return Excel::download(new DoneProcessedScriptExport, 'done_processed_scripts_'.date('YmdHis').'.xlsx');
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
        $script = Script::findOrFail($id);

        return view('admin.pages.scripts.show', compact('script'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $script = Script::findOrFail($id);

        return view('admin.pages.scripts.edit', compact('script'));
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
            'foreword' => 'required|string|max:65535',
            'references' => 'required|string|max:65535',
            'status' => 'required|string|',
        ]);

        $script = Script::findOrFail($id);

        if ($request->status == 'Pending') {
            $script->update([
                'title' => $request->title,
                'foreword' => $request->foreword,
                'references' => $request->references,
                'reviewed_at' => NULL,
                'done_reviewed_at' => NULL,
            ]);
        } elseif ($request->status == 'Proses') {
            $script->update([
                'title' => $request->title,
                'foreword' => $request->foreword,
                'references' => $request->references,
                'reviewed_at' => $script->reviewed_at ?? date('Y-m-d H:i:s'),
                'done_reviewed_at' => NULL,
            ]);
        } elseif ($request->status == 'Selesai') {
            $script->update([
                'title' => $request->title,
                'foreword' => $request->foreword,
                'references' => $request->references,
                'reviewed_at' => $script->reviewed_at ?? date('Y-m-d H:i:s'),
                'done_reviewed_at' => $script->done_reviewed_at ?? date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('admin.scripts.index')->with('toast_success', 'Berhasil menyimpan naskah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $script = Script::findOrFail($id);

        $filePath = 'storage/member/scripts/'.$script->member_id.'/'.$script->file;

        if (File::isFile($filePath)) {
            File::delete($filePath);
        }

        $script->delete();

        return back()->with('toast_success', 'Berhasil menghapus naskah.');
    }
}
