<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Barang;
//kategori
use App\Models\Kategori;

class ExportBarang implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //select barang inner join kategori where status_barang = 0(non active), 1(active), 2(deleted)
        $barang = Barang::join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            // ->where('barang.STATUS_BARANG', '!=', 2)
            ->get();
        // dd($barang);
        
        //add column barrang if status_barang = 0 then non active, 1 then active  and 2 then deleted
        foreach($barang as $key => $value){
            if($value->STATUS_BARANG == 0){
                $barang[$key]->status_barang = 'Tidak Aktif';
            } else if($value->STATUS_BARANG == 1){
                $barang[$key]->status_barang = 'Aktif';
            } else if($value->STATUS_BARANG == 2){
                $barang[$key]->status_barang = 'Hapus';
            }
        }
      

        //append barang column name to the top
        $barang->prepend([
            'id_barang' => 'ID Barang',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'merk' => 'Merk',
            'harga_beli' => 'Harga Beli',
            'harga_jual' => 'Harga Jual',
            'satuan_barang' => 'Satuan Barang',
            'stok' => 'Stok',
            'tgl_input' => 'Tanggal Input',
            'tgl_update' => 'Tanggal Update',
            'id_kategori' => 'ID Kategori',
            'STATUS_BARANG' => 'Status Barang',
            'nama_kategori' => 'Nama Kategori',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status_barang' => 'Status Barang'
        ]);


            
        return $barang;
    }
}
