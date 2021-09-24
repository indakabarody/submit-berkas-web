<?php

namespace App\Exports;

use App\Models\Script;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DoneProcessedScriptExport implements FromView
{
    public function view(): View
    {
        $scripts = Script::whereNotNull('reviewed_at')
                    ->whereNotNull('done_reviewed_at')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('exports.excel.scripts', compact('scripts'));
    }
}
