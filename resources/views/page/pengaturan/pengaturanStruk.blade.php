@extends('layouts.app', ['menu' => 'pengaturanStruk'])

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <h1 class="text-center">Pengaturan Struk</h1>
        <div class="widget-content widget-content-area br-6">
            <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <hr />
                <h3>Pengaturan Printer Nota</h3>

                <!-- Lebar Kertas Struk -->
                <div class="form-group">
                    <label for="lebar_kertas_struk">Lebar Kertas Struk</label>
                    <div class="input-group">
                        <select class="form-control select2" style="width:200px" id="lebar_kertas_struk"
                            name="lebar_kertas_struk">
                            <option value="58" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '58' ? 'selected' : '' }}>
                                58 mm (Thermal)
                            </option>
                            <option value="80" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '80' ? 'selected' : '' }}>
                                80 mm (Thermal)
                            </option>
                            <option value="95" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '95' ? 'selected' : '' }}>
                                95 mm
                            </option>
                            <option value="100" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '100' ? 'selected' : '' }}>
                                100 mm
                            </option>
                            <option value="110" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '110' ? 'selected' : '' }}>
                                110 mm
                            </option>
                            <option value="160" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '160' ? 'selected' : '' }}>
                                160 mm
                            </option>
                            <option value="210" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '210' ? 'selected' : '' }}>
                                210 mm (Epson LX-310)
                            </option>
                            <option value="254" {{ isset($pengaturan->lebar_kertas_struk) && $pengaturan->lebar_kertas_struk == '254' ? 'selected' : '' }}>
                                254 mm (Tractor Maks)
                            </option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text">mm</span>
                        </div>
                    </div>
                </div>

                <!-- Gunakan Logo -->
                <div class="form-group">
                    <label for="gunakan_logo_struk">Gunakan Logo pada Struk?</label>
                    <select name="gunakan_logo_struk" id="gunakan_logo_struk" class="form-control" style="width: 200px;">
                        <option value="Ya" {{ isset($pengaturan) && $pengaturan->gunakan_logo_struk == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ isset($pengaturan) && $pengaturan->gunakan_logo_struk == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <!-- Format Struk -->
                <div class="form-group">
                    <label>Format Struk</label>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <input type="radio" name="format_struk" value="1" id="format1"
                                {{ isset($pengaturan->format_struk) && $pengaturan->format_struk == '1' ? 'checked' : '' }}>

                            <p class="mt-2 mb-1"><strong>Format 1 - Bon Pembelian (Timbangan)</strong></p>

                            <!-- PREVIEW DUMMY BON PEMBELIAN -->
                            @php
                                $dummyPengaturan = (object) [
                                    'nama_toko' => $pengaturan->nama_toko ?? 'PT. SAWIT MAKMUR JAYA',
                                    'lebar_kertas_struk' => 80,
                                ];

                                $dummyTimbangan = (object) [
                                    'satpam'              => 'SPM-01',
                                    'slip_outdate'        => '2025-04-08',
                                    'slip_indate'         => '2025-04-08',
                                    'kode_slip'           => 'SLP-250408-00123',
                                    'perusahaan_supplier' => 'CV. BERKAH SAWIT',
                                    'no_polisi'           => 'BA 4567 XY',
                                    'nama_stok'           => 'KELAPA SAWIT GRADE A',
                                    'slip_intime'         => '08:15',
                                    'slip_outtime'        => '09:45',
                                    'berat_bruto'         => 12500,
                                    'berat_tara'          => 3200,
                                    'berat_netto1'        => 9300,
                                    'berat1_potPersen'    => 2.5,
                                    'berat1_potKg'        => 232,
                                    'berat2_potPersen'    => 0.5,
                                    'berat2_potKg'        => 45,
                                    'berat_netto2'        => 9023,
                                    'catatan'             => 'Kualitas bagus, bersih dari kotoran',
                                    'nama_operator'       => 'ANDI SAPUTRA',
                                ];
                            @endphp

                            <section style="width: 80mm; padding: 10px; margin: 15px auto; box-shadow: 0 0 8px rgba(0,0,0,0.15); background: white; border-radius: 8px; font-size: 12px; font-family: Arial, sans-serif;">
                                <div style="font-weight:bold; font-size:18px; text-align:center;">
                                    {{ $dummyPengaturan->nama_toko }}
                                </div>
                                <div style="display:flex; justify-content:space-between; margin-top:8px;">
                                    <div style="font-size:22px; font-weight:bold;">BON PEMBELIAN</div>
                                    <div style="font-size:32px; font-weight:900;">{{ strtoupper($dummyTimbangan->satpam) }}</div>
                                </div>
                                <hr style="border-top:1px dashed #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0;">
                                    <div style="width:150px;">Tgl</div>
                                    <div>:</div>
                                    <div style="margin-left:8px;">{{ date('d-m-Y', strtotime($dummyTimbangan->slip_outdate)) }}</div>
                                </div>
                                <div style="display:flex; margin:4px 0;">
                                    <div style="width:150px;">No. Slip</div>
                                    <div>:</div>
                                    <div style="margin-left:8px;">{{ $dummyTimbangan->kode_slip }}</div>
                                </div>
                                <hr style="border-top:1px dashed #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0;"><div style="width:150px;">Nama Relasi</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->perusahaan_supplier }}</div></div>
                                <div style="display:flex; margin:4px 0;"><div style="width:150px;">No. Polisi</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->no_polisi }}</div></div>
                                <div style="display:flex; margin:4px 0;"><div style="width:150px;">Nama Barang</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->nama_stok }}</div></div>
                                <hr style="border-top:1px dashed #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0;"><div style="width:150px;">Jam Masuk</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->slip_intime }}</div></div>
                                <div style="display:flex; margin:4px 0;"><div style="width:150px;">Jam Keluar</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->slip_outtime }}</div></div>
                                <hr style="border-top:1px dashed #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0; font-size:13px;">
                                    <div style="width:150px;">Berat Bruto</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat_bruto) }} Kg</div>
                                </div>
                                <div style="display:flex; margin:4px 0; font-size:13px;">
                                    <div style="width:150px;">Berat Tara</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat_tara) }} Kg</div>
                                </div>
                                <div style="display:flex; margin:4px 0; font-size:13px;">
                                    <div style="width:150px;">Berat Netto I</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat_netto1) }} Kg</div>
                                </div>
                                <div style="display:flex; margin:4px 0; font-size:13px;">
                                    <div style="width:150px;">Potongan {{ $dummyTimbangan->berat1_potPersen }}%</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat1_potKg) }} Kg</div>
                                </div>
                                <div style="display:flex; margin:4px 0; font-size:13px;">
                                    <div style="width:150px;">Pot tambahan {{ $dummyTimbangan->berat2_potPersen }}%</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat2_potKg) }} Kg</div>
                                </div>
                                <hr style="border-top:2px solid #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0; font-size:15px; font-weight:bold;">
                                    <div style="width:150px;">Berat Netto II</div><div>:</div><div style="margin-left:8px; text-align:right; flex:1;">{{ number_format($dummyTimbangan->berat_netto2) }} Kg</div>
                                </div>
                                <hr style="border-top:1px dashed #000; margin:8px 0;">
                                <div style="display:flex; margin:4px 0;">
                                    <div style="width:150px;">Keterangan</div><div>:</div><div style="margin-left:8px;">{{ $dummyTimbangan->catatan }}</div>
                                </div>
                                <br>
                                <div style="text-align:center; margin-top:20px;">
                                    <small>Ditimbang Oleh</small><br><br>
                                    <strong>{{ $dummyTimbangan->nama_operator }}</strong>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- Footer Struk -->
                <div class="form-group">
                    <label for="footer_struk">Footer Struk</label>
                    <textarea class="form-control" id="footer_struk" name="footer_struk" rows="3">{{ $pengaturan->footer_struk ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>

            <!-- Tombol Test Print -->
            <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data" target="_blank" class="mt-3">
                @csrf
                <button type="submit" name="print_nota" value="1" class="btn btn-secondary">Test Print Nota</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            @if (session('success'))
                Swal.fire({ icon: "success", title: 'Success', text: '{{ session("success") }}' });
            @endif
        });
    </script>
@endsection