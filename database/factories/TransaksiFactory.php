<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TransaksiFactory extends Factory
{
    public function definition(): array
    {
        $jumlahBarang = fake()->numberBetween(1, 50);
        $hargaSatuan = fake()->numberBetween(1000, 500000);

        // pilih bulan random
        $bulan = fake()->numberBetween(1, 12);

        // pilih tanggal dalam bulan tersebut
        $tanggal = Carbon::create(
            now()->year,
            $bulan,
            fake()->numberBetween(1, 28),
            fake()->numberBetween(0, 23),
            fake()->numberBetween(0, 59),
            fake()->numberBetween(0, 59)
        );

        return [
            'id_barang' => fake()->numberBetween(1, 100),

            'tipe_transaksi' => fake()->randomElement([
                'masuk',
                'keluar'
            ]),

            'jumlah_barang' => $jumlahBarang,

            'harga_satuan' => $hargaSatuan,

            'jumlah_satuan' => $jumlahBarang * $hargaSatuan,

            'keterangan_transaksi' => fake()->sentence(),

            'diberikan_oleh' => fake()->name(),

            'keperluan_transaksi' => fake()->randomElement([
                'Operasional',
                'Gudang',
                'Penjualan',
                'Maintenance',
                'Distribusi',
            ]),

            'tanggal_transaksi' => $tanggal,

            'created_at' => $tanggal,
            'updated_at' => $tanggal,
            'deleted_at' => null,
        ];
    }
}