<?php

namespace App\Exports;

use App\Models\Script;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllScriptExport implements FromView
{
    public function view(): View
    {
        return view('exports.excel.scripts', [
            'scripts' => Script::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
