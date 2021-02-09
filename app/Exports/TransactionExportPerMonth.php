<?php

namespace App\Exports;

use App\Cart;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class TransactionExportPerMonth implements
    WithEvents,
    WithTitle,
    ShouldAutoSize,
    FromView
{
    private $month;
    private $year;
    private $i;
    private $row;
    private $rowMax;
    public function __construct(int $year, int $month, int $i, int $row, int $rowMax)
    {
        $this->month = $month;
        $this->year  = $year;
        $this->i = $i;
        $this->row = $row;
        $this->rowMax = $rowMax;
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $month = DateTime::createFromFormat('!m', $this->month)->format('F');
        $item = DB::table('products')
            ->get();
        $data = DB::table('carts')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->where('status', 'complete')
            ->get();
        $count = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', $this->month)
            ->sum('carts.price');
        $itemSold = DB::table('carts')
            ->whereMonth('carts.created_at', '=', $this->month)
            ->where('status', '=', 'complete')
            ->get();
        $sum = DB::table('carts')
            ->join('products', 'carts.id_item', '=', 'products.id')
            ->whereMonth('carts.created_at', '=', $this->month)
            ->where('status', '=', 'complete')
            ->sum('carts.qty');
        // dd($itemSold);
        $product = DB::table('products')->get();
        return view('export', compact('sum', 'total', 'itemSold', 'product', 'data', 'item', 'month', 'count'));
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return DateTime::createFromFormat('!m', $this->month)->format('F');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->styleCells(
                    'A2:H' . $this->i,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '0000000'],
                            ],
                        ],

                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],

                    ]
                );
                $event->sheet->styleCells(
                    'A' . $this->row . ':C' . $this->rowMax,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '0000000'],
                            ],
                        ],

                    ]
                );
            }
        ];
    }
}
