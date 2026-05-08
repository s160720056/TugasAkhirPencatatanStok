<html>

<head>
    <title>Cetak Nota</title>
    <style>
        @page {
            margin: 0
        }

        body {
            padding-left: 20px;
            font-size: 12px;
            font-family: Arial, sans-serif;
            color: #000000;
            background-color: #f9f9f9;
            width: calc({{ $pengaturan->lebar_kertas_struk }}mm - 30px);

        }

        td,
        th {
            font-size: 12px;
            padding: 0px;
        }

        .sheet {
            width: calc({{ $pengaturan->lebar_kertas_struk }}mm - 30px);
            /* Adjust width to fit within the paper */
            padding: 0px;
            margin: auto;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 5px;
        }

        .txt-left {
            text-align: left;
        }

        .txt-center {
            text-align: center;
        }

        .txt-right {
            text-align: right;
        }

        hr {
            border: 0;
            border-top: 1px dashed #ccc;
            margin: 8px 0;
            color: #000000;
        }

        h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .footer-message {
            font-size: 11px;
            color: #000000;
            margin-top: 10px;
        }

        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 5px;
            }

            .sheet {
                box-shadow: none;
                border-radius: 0;
            }

            .footer-message {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .sheet {
            width: calc({{ $pengaturan->lebar_kertas_struk }}mm - 30px);
            margin: auto;
        }

        .header {
            font-weight: bold;
            font-size: 18px;
            padding-top:30px;
        }

        .title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
        }

        .kode-truk {
            font-size: {{ strlen($timbangan->satpam ?? '') > 4 ? 'clamp(18px, 8vw, 25px)' : '40px' }};
            text-align: {{ strlen($timbangan->satpam ?? '') > 4 ? 'auto' : 'right' }};
            margin-right: {{ strlen($timbangan->satpam ?? '') > 4 ? '0px' : '15px' }};
            font-weight: 900;
        }

        .row {
            display: flex;
            margin: 4px 0;
        }

        .label {
            width: 150px;
        }

        .separator {
            width: 10px;
        }

        .value {
            flex: 1;
        }

        .right {
            text-align: right;
        }

        .hr {
            border-bottom: 1px solid #000;
            margin: 8px 0;
        }

        .big {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body onload="printOut()">
    <section class="sheet">

        <div class="header">
            {{ $pengaturan->nama_toko }}
        </div>

        <div class="title-row">
            <div class="title" style="width:50%">BON PEMBELIAN</div>
            <div class="kode-truk" style="width:50%;text-align:right">{{ strtoupper($timbangan->satpam ?? '') }}</div>
        </div>

        <div class="hr"></div>

        <div class="row">
            <div class="label">Tgl : {{ date('d-m-Y', strtotime($timbangan->slip_outdate ?? $timbangan->slip_indate)) }}
            </div>
            <div class="separator"></div>
            <div class="value"></div>


            <div class="label right">No. Bon : {{ substr($timbangan->kode_slip, 5) }}</div>
            <div class="separator"></div>
            <div class="value"></div>
        </div>

        <div class="hr"></div>

        <div class="row">
            <div class="label">Nama Relasi</div>
            <div class="separator">:</div>
            <div class="value">{{ $timbangan->perusahaan_supplier }}</div>
        </div>

        <div class="row">
            <div class="label">No. Polisi</div>
            <div class="separator">:</div>
            <div class="value">{{ $timbangan->no_polisi }}</div>
        </div>

        <div class="row">
            <div class="label">Nama Barang</div>
            <div class="separator">:</div>
            <div class="value">{{ $timbangan->nama_stok }}</div>
        </div>

        <br>

        <div class="row">
            <div class="label">Jam Masuk</div>
            <div class="separator">:</div>
            <div class="value">{{ date('H:i:s', strtotime($timbangan->slip_intime)) }}</div>
        </div>

        <div class="row">
            <div class="label">Jam Keluar</div>
            <div class="separator">:</div>
            <div class="value">{{ date('H:i:s', strtotime($timbangan->slip_outtime)) }}</div>
        </div>

        <br>

        <div class="row">
            <div class="label">Berat Bruto</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat_bruto, 0, ',', '.') }} Kg</div>
        </div>

        <div class="row">
            <div class="label">Berat Tara</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat_tarra, 0, ',', '.') }} Kg</div>
        </div>

        <div class="row">
            <div class="label">Berat Netto I</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat_netto1, 0, ',', '.') }} Kg</div>
        </div>

        <div class="row">
            <div class="label">Potongan {{ $timbangan->berat1_potPersen ?? 0 }} %</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat1_potKg ?? 0, 0, ',', '.') }} Kg</div>
        </div>

        <div class="row">
            <div class="label">Pot tambahan {{ $timbangan->berat2_potPersen ?? 0 }}%</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat2_potKg ?? 0, 0, ',', '.') }} Kg</div>
        </div>

        <div class="hr"></div>

        <div class="row big">
            <div class="label">Berat Netto II</div>
            <div class="separator">:</div>
            <div class="value right">{{ number_format($timbangan->berat_netto2 ?? 0, 0, ',', '.') }} Kg</div>
        </div>

        <br>

        <div class="row">
            <div class="label">Keterangan</div>
            <div class="separator">:</div>
            <div class="value">{{ $timbangan->catatan ?? '' }}</div>
        </div>

        <br><br>

        <div class="row">
            <div class="label">Ditimbang Oleh</div>
            <div class="separator"></div>
            <div class="value"></div>
        </div>
        <br><br><br>


        <div class="row">
            <div class="label">{{ $timbangan->nama_operator }}</div>
            <div class="separator"></div>
            <div class="value"></div>
        </div>
        <br><br><br>
    </section>
</body>

</html>

<script>
    function printOut() {
        window.print();
        setTimeout(() => window.close(), 1000);
    }
</script>
