<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BarangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_barang' => 'BRG-' . fake()->unique()->numerify('####'),

            'STATUS_BARANG' => fake()->randomElement([
                '1'
            ]),

            'nama_barang' => fake()->randomElement([
                'Laptop',
                'Mouse',
                'Keyboard',
                'Monitor',
                'Printer',
                'Scanner',
                'Harddisk',
                'SSD',
                'Router',
                'Switch'
            ]) . ' ' . strtoupper(fake()->bothify('??##')),

            'harga_satuan' => fake()->numberBetween(50000, 10000000),

            'seri' => strtoupper(fake()->bothify('SR-####-??')),

            'stok_awal' => fake()->numberBetween(0, 500),

            'tanggal_input' => Carbon::instance(
                fake()->dateTimeBetween('-1 year', 'now')
            ),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}