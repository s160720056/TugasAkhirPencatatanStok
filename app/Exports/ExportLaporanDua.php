<?php
    namespace App\Exports;

    use App\Models\NotaDetail;
    use Illuminate\Support\Facades\DB;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\WithEvents;
    use Maatwebsite\Excel\Concerns\WithHeadingRow;
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Maatwebsite\Excel\Concerns\WithMapping;
    use Maatwebsite\Excel\Concerns\WithStartRow;
    use Maatwebsite\Excel\Concerns\WithStyles;
    use Maatwebsite\Excel\Events\AfterSheet;

    class ExportLaporanDua implements FromCollection, WithMapping, WithHeadingRow, WithHeadings, WithStyles, WithEvents
    {
        protected $tgl, $toko;

        public function __construct($tgl,$idtoko)
        {
          $this->tgl       = $tgl;
            $this->toko      = $idtoko;
        }

        public function collection()
        {
            return NotaDetail::join('barang', 'barang.id_barang', '=', 'nota_detail.id_barang')
            ->join('nota', 'nota.id_nota', '=', 'nota_detail.id_nota')
            ->join(DB::raw(DB::connection('mysql')->getDatabaseName() . '.user'),  'user.id_user', '=', 'nota.id_user')
            ->select(
                'barang.id_barang',
                'barang.nama_barang',
                'nota_detail.jumlah',
                'barang.harga_beli',
                'nota_detail.harga',
                'nota.ppn',
                DB::raw('((nota_detail.harga * (nota.ppn / 100))+nota_detail.harga) AS total_harga_ppn'), // Compute and alias the result
                'user.username',
                'nota.tanggal_input',
                'nota.Referensi'
            )->whereDate('nota.tanggal_input', $this->tgl)
            ->where('nota.id_toko', $this->toko)
            ->orderBy('nota.tanggal_input', 'desc')->get()->map(function ($value) {
                return [
                    $value->Referensi,
                    $value->nama_barang,
                    $value->jumlah,
                    $value->harga_beli,
                    $value->ppn,
                    $value->total_harga_ppn,
                    $value->username,
                ];
            });
        }

        public function headingRow(): int
        {
            return 4;
        }

        public function headings(): array
        {
            return [
                ['Laporan Penjualan'],
                ['Toko: ' . $this->toko],
                ['Tanggal: ' . $this->tgl],
                ['No', 'Referensi', 'Nama Barang', 'Jumlah', 'Modal', 'PPN', 'Harga Jual (PPN)', 'Kasir']
            ];
        }

        public function styles($collect)
        {
            return [
                1 => ['font' => ['bold' => true, 'size' => 14]],
                2 => ['font' => ['bold' => true, 'size' => 12]],
                3 => ['font' => ['bold' => true, 'size' => 12]],
                4 => ['font' => ['bold' => true, 'size' => 12]],
            ];
        }

        public function map($row): array
        {
            static $no = 0;
            $no++;
            return [
                $no,                                      // Adjusted Column: No
                $row[0],                                  // Column: Referensi
                $row[1],                                  // Column: Nama Barang
                $row[2],                                  // Column: Jumlah
                'Rp. ' . number_format($row[3], 0, ',', '.'), // Column: Modal
                $row[4],                                  // Column: PPN
                'Rp. ' . number_format($row[5], 0, ',', '.'), // Column: Harga Jual (PPN)
                $row[6],                                  // Column: Kasir
            ];
        }
        
        public function registerEvents(): array
        {
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    // Title and subtitle
                    $nama_toko= DB::table('toko')->where('id_toko', $this->toko)->value('nama_toko');
                    $event->sheet->setCellValue('A1', 'Laporan Penjualan');
                    $event->sheet->setCellValue('A2', 'Toko: ' . $nama_toko);
                    $event->sheet->setCellValue('A3', 'Tanggal: ' . $this->tgl);
                    $event->sheet->mergeCells('A1:H1');
                    $event->sheet->mergeCells('A2:H2');
                    $event->sheet->mergeCells('A3:H3');
                    $event->sheet->getStyle('A1:A3')->getFont()->setBold(true)->setSize(14);
                    $event->sheet->getStyle('A1:A3')->getAlignment()->setHorizontal('center');

                    // Headings
                    $event->sheet->setCellValue('A4', 'No');
                    $event->sheet->setCellValue('B4', 'Referensi');
                    $event->sheet->setCellValue('C4', 'Nama Barang');
                    $event->sheet->setCellValue('D4', 'Jumlah');
                    $event->sheet->setCellValue('E4', 'Modal');
                    $event->sheet->setCellValue('F4', 'PPN');
                    $event->sheet->setCellValue('G4', 'Harga Jual (PPN)');
                    $event->sheet->setCellValue('H4', 'Kasir');
                    $event->sheet->getStyle('A4:H4')->getFont()->setBold(true);
                    $event->sheet->getStyle('A4:H4')->getAlignment()->setHorizontal('center');

                    // Auto-size columns
                    foreach (range('A', 'H') as $col) {
                        $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                    }

                    // Align center for rows > 5
                    $highestRow = $event->sheet->getHighestRow();
                    $event->sheet->getStyle('A5:H' . $highestRow)->getAlignment()->setHorizontal('center');
                },
            ];
        }
    }
        

// public function registerEvents(): array
// {
//     return [
//         AfterSheet::class => function (AfterSheet $event) {
//             // Title and subtitle
//             $event->sheet->setCellValue('A1', 'Laporan Penjualan');
//             $event->sheet->setCellValue('A2', 'Toko: ' . $this->toko);
//             $event->sheet->setCellValue('A3', 'Periode: ' . $this->bln . '/' . $this->thn);
//             $event->sheet->mergeCells('A1:H1');
//             $event->sheet->mergeCells('A2:H2');
//             $event->sheet->mergeCells('A3:H3');
//             $event->sheet->getStyle('A1:A3')->getFont()->setBold(true)->setSize(14);
//             $event->sheet->getStyle('A1:A3')->getAlignment()->setHorizontal('center');

//             // Headings
//             $event->sheet->setCellValue('A4', 'No');
//             $event->sheet->setCellValue('B4', 'Referensi');
//             $event->sheet->setCellValue('C4', 'Nama Barang');
//             $event->sheet->setCellValue('D4', 'Jumlah');
//             $event->sheet->setCellValue('E4', 'Modal');
//             $event->sheet->setCellValue('F4', 'PPN');
//             $event->sheet->setCellValue('G4', 'Harga Jual (PPN)');
//             $event->sheet->setCellValue('H4', 'Kasir');
//             $event->sheet->getStyle('A4:H4')->getFont()->setBold(true);
//             $event->sheet->getStyle('A4:H4')->getAlignment()->setHorizontal('center');

//             // Auto-size columns
//             foreach (range('A', 'H') as $col) {
//                 $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
//             }
//         },
//     ];
// }

    