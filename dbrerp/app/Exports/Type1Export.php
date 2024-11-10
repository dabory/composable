<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Type1Export implements FromCollection, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $type1;

    public function __construct(Collection $type1)
    {
        $this->type1 = $type1;
    }

    public function collection()
    {
        return $this->type1;
    }

    public function columnWidths(): array
    {
        return [
//            'A' => 55,
//            'B' => 45,
//            'C' => 45,
//            'F' => 100,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('B2')->getFont()->setBold(true);

        return [

            // Style the first row as bold text.
            1   => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],

        ];
    }
}
