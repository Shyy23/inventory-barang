<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class ItemsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return DB::table('vitems')
            ->when($this->filters['search'] ?? null, function ($query, $search) {
                $query->where('item_name', 'like', "%{$search}%");
            })
            ->get()
            ->map(function ($item) {
                return [
                    'ID' => $item->item_id,
                    'Nama Barang' => $item->item_name,
                    'Kategori' => $item->category_name,
                    'Deskripsi' => $item->description,
                    'Lokasi' => $item->location_name,
                    'Stok' => $item->stock,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Kategori',
            'Deskripsi',
            'Lokasi',
            'Stok'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Warna header (ubah sesuai kebutuhan)
        $headerColor = '6A5ACD'; // Ungu soft
        
        // Warna border umum
        $borderColor = '000000'; 
        $borderStyle = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
    
        // Style untuk seluruh tabel
        $fullTableStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => $borderStyle,
                    'color' => ['rgb' => $borderColor]
                ]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ];
        
        // Terapkan border dan alignment ke seluruh tabel
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:F{$lastRow}")->applyFromArray($fullTableStyle);
    
        // Styling untuk header
        $sheet->getStyle('A1:F1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => $headerColor]
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true,
                'size' => 12
            ]
        ]);
    
        // Terapkan border ke seluruh tabel
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:F{$lastRow}")->applyFromArray($fullTableStyle);
    
        // Pertebal border bawah header
        $sheet->getStyle('A1:F1')->getBorders()->getBottom()->setBorderStyle(
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
        );
    
        // Auto size kolom dengan pengecualian untuk deskripsi
        foreach(range('A','F') as $column) {
            if($column === 'D') { // Kolom Deskripsi
                $sheet->getColumnDimension($column)
                    ->setAutoSize(false)
                    ->setWidth(50); // Max width 50 karakter
            } else {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
        }
    
        // Text wrapping untuk deskripsi dengan alignment vertikal top
        $sheet->getStyle("D2:D{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Tengah
                'wrapText' => true
            ]
        ]);
        
    
        return [];
    }
}