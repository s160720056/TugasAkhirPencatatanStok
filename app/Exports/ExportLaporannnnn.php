<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use App\Models\NotaDetail;

class ExportLaporannnnn implements FromCollection, WithHeadings, WithMapping
{
    protected $bln, $thn, $referensi, $toko;

    public function __construct($bln, $thn, $referensi, $idtoko)
    {
        $this->bln = $bln;
        $this->thn = $thn;
        $this->referensi = $referensi;
        $this->toko = $idtoko;
    }

    public function collection()
    {
        $laporan = NotaDetail::join('barang', 'barang.id_barang', '=', 'nota_detail.id_barang')
        ->join('nota', 'nota.id_nota', '=', 'nota_detail.id_nota')
        ->join(DB::raw(DB::connection('mysql')->getDatabaseName() . '.user'),  'user.id_user', '=', 'nota.id_user')
        ->select(
            'nota.Referensi',
            'barang.nama_barang',
            'nota_detail.jumlah',
            'barang.harga_beli',
            'nota.ppn',
            DB::raw('((nota_detail.harga * (nota.ppn / 100))+nota_detail.harga) AS total_harga_ppn'), // Compute and alias the result
            'user.username'
        )
        ->when($this->bln, function ($query, $bln) {
            return $query->whereMonth('nota.tanggal_input', $bln);
        })
        ->whereYear('nota.tanggal_input', $this->thn)
        ->where('nota.id_toko', $this->toko)
        ->where('nota.Referensi', 'like', '%'.$this->referensi.'%')
        ->orderBy('nota.tanggal_input', 'desc')->get();
        
        $collect = [];
        foreach ($laporan as $value) {
            $collect[] = [
                $value->Referensi,
                $value->nama_barang,
                $value->jumlah,
                $value->harga_beli,
                $value->ppn,
                $value->total_harga_ppn,
                $value->username
            ];
        }
        return collect($collect);
    }

    public function headings(): array
    {
        return [
            'No', 'Referensi', 'Nama Barang', 'Jumlah', 'Modal', 'PPN', 'Harga Jual (PPN)', 'Kasir'
        ];
    }

    public function map($row): array
    {
        static $no = 1;
        return [
            $no++,         // Kolom No
            $row[0],       // Referensi
            $row[1],       // Nama Barang
            $row[2],       // Jumlah
            $row[3],       // Modal
            $row[4],       // PPN
            $row[5],       // Harga Jual (PPN)
            $row[6],       // Kasir
        ];
    }
    
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $sheet = $event->sheet;
        
    //             // Nama toko
    //             $nama_toko = DB::table('toko')->where('id_toko', $this->toko)->value('nama_toko') ?? 'Toko Tidak Ditemukan';
        
    //             // Merge cells and set values
    //             $sheet->mergeCells('B4:I4');
    //             $sheet->setCellValue('B4', $nama_toko);
        
    //             $sheet->mergeCells('B5:I5');
    //             $sheet->setCellValue('B5', 'Laporan Penjualan');
        
    //             $sheet->mergeCells('B6:I6');
    //             $sheet->setCellValue('B6', "Periode " . date('F', mktime(0, 0, 0, $this->bln, 10)) . " {$this->thn}");
        
    //             // Styling
    //             $sheet->getStyle('B4:I6')->applyFromArray([
    //                 'font' => [
    //                     'bold' => true,
    //                     'size' => 12,
    //                 ],
    //                 'alignment' => [
    //                     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //                 ],
    //             ]);
        
    //             // Header
    //             $sheet->getStyle('B7:I7')->applyFromArray([
    //                 'font' => ['bold' => true],
    //                 'alignment' => [
    //                     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //                 ],
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                     ],
    //                 ],
    //             ]);
        
    //             // Data row styling
    //             $dataRange = 'B8:I' . (8 + $this->collection()->count() - 1);
    //             $sheet->getStyle($dataRange)->applyFromArray([
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                     ],
    //                 ],
    //             ]);
        
    //             // Adjust column widths
    //             foreach (range('B', 'I') as $column) {
    //                 $sheet->getColumnDimension($column)->setAutoSize(true);
    //             }
    //         },
    //     ];
    // }
}
