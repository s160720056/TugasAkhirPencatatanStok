<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//id_barang,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,STATUS_BARANG,tgl_input,tgl_update,id_kategori
        $data = [
            [

                'nama_barang' => 'Buku Tulis',
                'merk' => 'Buku Tulis',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Pensil',
                'merk' => 'Faber Castell',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Penghapus',
                'merk' => 'Joyko',
                'harga_beli' => 1000,
                'harga_jual' => 2000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Penggaris',
                'merk' => 'Joyko',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Buku Gambar',
                'merk' => 'Buku Gambar',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Pensil Warna',
                'merk' => 'Faber Castell',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Pensil 2B',
                'merk' => 'Faber Castell',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
            [

                'nama_barang' => 'Pensil 4B',
                'merk' => 'Faber Castell',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'satuan_barang' => 'pcs',
                'stok' => 100,
                'STATUS_BARANG' => '1',
                'tgl_input' => '2021-01-01',
                'tgl_update' => '2021-01-01',
                'id_kategori' => 1,
            ],
        ];

        \DB::table('barang')->insert($data);
        //php artisan db:seed --class=BarangSeeder

    }
}
