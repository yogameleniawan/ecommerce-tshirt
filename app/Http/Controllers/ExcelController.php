<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportView()
    {
        return view('export');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new TransactionExport(2021), 'Transaction Report.xlsx');
    }
}
