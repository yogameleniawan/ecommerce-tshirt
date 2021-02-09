<?php

namespace App\Exports;

use App\Cart;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionExport implements WithMultipleSheets, ShouldAutoSize
{
    use Exportable;

    protected $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }


    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $i = DB::table('carts')
                ->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $month)
                ->where('status', 'complete')
                ->count();
            $product = DB::table('products')
                ->count();
            $row = $i + 5;
            $rowMax = $row + $product;
            $sheets[] = new TransactionExportPerMonth($this->year, $month, $i + 3, $row, $rowMax + 2);
        }

        return $sheets;
    }
}
