<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    protected $commands;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function view(): View
    {
        return view('admins.exports.commands-excel', [
            'commands' => $this->commands
        ]);
    }
}
