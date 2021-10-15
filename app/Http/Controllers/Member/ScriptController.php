<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Script;
use App\Notifications\NewScriptNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

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
        return view('member.pages.scripts.create');
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
            'foreword' => 'nullable|max:65535',
            'references' => 'required|string|max:65535',
            'file' => 'required|file|mimes:pdf,rar,zip,doc,docx',
        ]);

        $path = 'storage/member/scripts/' . Auth::user()->id;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $file = $request->file('file');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($path, $fileName);

        Script::create([
            'member_id' => Auth::user()->id,
            'title' => $request->title,
            'foreword' => $request->foreword,
            'references' => $request->references,
            'file' => $fileName,
        ]);

        $admins = Admin::all();
        Notification::send($admins, new NewScriptNotification());

        return redirect()->route('member.scripts.index')->with('toast_success', 'Berhasil menambahkan naskah.');
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

        return view('member.pages.scripts.show', compact('script'));
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

        return view('member.pages.scripts.edit', compact('script'));
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
            'foreword' => 'nullable|string|max:65535',
            'references' => 'required|string|max:65535',
            'file' => 'nullable|file|mimes:pdf,zip,doc,docx',
        ]);

        if ($request->file != NULL) {
            $file = $request->file('file');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'storage/member/scripts/' . Auth::user()->id;

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true);
            }

            $file->move($path, $fileName);

            Script::findOrFail($id)->update([
                'member_id' => Auth::user()->id,
                'title' => $request->title,
                'foreword' => $request->foreword,
                'references' => $request->references,
                'file' => $fileName,
            ]);
        } else {
            Script::findOrFail($id)->update([
                'member_id' => Auth::user()->id,
                'title' => $request->title,
                'foreword' => $request->foreword,
                'references' => $request->references,
            ]);
        }

        return redirect()->route('member.scripts.index')->with('toast_success', 'Berhasil menyimpan naskah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $script = Script::where([
            'id' => $id,
            'member_id' => Auth::user()->id,
        ])->firstOrFail();

        $filePath = 'storage/member/scripts/'.$script->member_id.'/'.$script->file;

        if (File::isFile($filePath)) {
            File::delete($filePath);
        }

        $script->delete();

        return back()->with('toast_success', 'Berhasil menghapus naskah.');
    }
}
