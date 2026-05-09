@extends('layouts.app', ['menu' => 'bukuStok'])
@section('content')
    @php
       //use Carbon for date format
       use Carbon\Carbon;
       Carbon::setLocale('id');
    @endphp

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.css">

    <style>
        .container {
            margin: 20px auto;
        }

        /* container */
        .container {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        /* flipbook */
        .flip-book {
            max-width: 1200px;
            width: 100%;
            height: 1500px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        /* page base */
        .page {
            padding: 20px;
            background-color: hsl(35, 55%, 98%);
            color: hsl(35, 35%, 35%);
            border: 1px solid hsl(35, 20%, 70%);
            overflow: hidden;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;

        }

        /* page layout */
        .page-content {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* header */
        .page-header {
            height: 30px;
            font-size: 16px;
            text-transform: uppercase;
            text-align: center;
        }

        /* image */
        .page-image {
            height: 100%;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* text */
        .page-text {
            flex-grow: 1;
            font-size: 13px;
            text-align: justify;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid hsl(35, 55%, 90%);
        }

        /* footer */
        .page-footer {
            height: 30px;
            border-top: 1px solid hsl(35, 55%, 90%);
            font-size: 12px;
            color: hsl(35, 20%, 50%);
        }

        /* left page */
        .page.--left {
            border-right: 0;
            box-shadow: inset -7px 0 30px -7px rgba(0, 0, 0, 0.4);
        }

        /* right page */
        .page.--right {
            border-left: 0;
            box-shadow: inset 7px 0 30px -7px rgba(0, 0, 0, 0.4);
        }

        /* hard page */
        .page.hard {
            background-color: hsl(35, 50%, 90%);
            border: 1px solid hsl(35, 20%, 50%);
        }

        /* cover */
        .page.page-cover {
            background-color: hsl(35, 45%, 80%);
            color: hsl(35, 35%, 35%);
            border: 1px solid hsl(35, 20%, 50%);
        }

        /* cover top */
        .page.page-cover-top {
            box-shadow:
                inset 0 0 30px rgba(36, 10, 3, 0.5),
                -2px 0 5px rgba(0, 0, 0, 0.4);
        }

        /* cover bottom */
        .page.page-cover-bottom {
            box-shadow:
                inset 0 0 30px rgba(36, 10, 3, 0.5),
                10px 0 8px rgba(0, 0, 0, 0.4);
        }

        /* cover title */
        .page.page-cover h2 {
            text-align: center;
            margin-top: 50%;
            font-size: 32px;
        }

        /* table transaksi */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table th {
            background: #f3e7d3;
            padding: 6px;
            border: 1px solid #c7b899;
        }

        table td {
            padding: 5px;
            border: 1px solid #d6cbb1;
        }

        /* zebra row */
        table tbody tr:nth-child(even) {
            background: #faf6ed;
        }

        /* saldo column */
        table td:last-child {
            font-weight: bold;
        }

        /* tombol */
        button {
            padding: 6px 12px;
            margin: 5px;
            border: 1px solid #aaa;
            background: #eee;
            cursor: pointer;
        }

        button:hover {
            background: #ddd;
        }

        .btn-export {
            display: inline-block;
            padding: 6px 12px;
            margin: 5px;
            border: 1px solid #aaa;
            background: #e8f0ff;
            color: #111;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-export:hover {
            background: #d2e0ff;
        }

        /* status text */
        .page-state,
        .page-orientation {
            font-weight: bold;
        }

        .page {
            width: 100%;
            height: 100%;
            padding: 20px;
            background-color: hsl(35, 55%, 98%);
            color: hsl(35, 35%, 35%);
            border: 1px solid hsl(35, 20%, 70%);
            overflow: hidden;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

    <div class="container">
        <div>
            <button type="button" class="btn-prev">Previous page</button>
            [<span class="page-current">Cover</span> of <span class="page-total">-</span>]
            <button type="button" class="btn-next">Next page</button>
             {{-- <a href="{{ route('transaksi.flipbook.pdf') }}" target="_blank" class="btn-export">Export PDF</a> --}}
        </div>

        <div>
            State: <i class="page-state">read</i>, orientation: <i class="page-orientation">landscape</i>
        </div>
    </div>


   <div class="flip-book" id="book">

        <!-- Cover -->
       <div class="page page-cover page-cover-top">
        <h2 style="text-align:center">BUKU STOK</h2>
        <p style="text-align:center; margin-top: 1rem;">Kartu Stok Barang</p>
    </div>

       <!-- ==================== DAFTAR BARANG - 2 HALAMAN ==================== -->
        <!-- Halaman 1 Daftar Barang -->
        <div class="page">
            <h3 style="text-align:center">Daftar Barang</h3>
            <p style="text-align:center; margin-bottom: 10px; font-size: 14px;">Halaman 1</p>
            
            <table>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Seri</th>
                    <th>Stok Awal</th>
                </tr>
                @php
                    $perPage = 25; // Sesuaikan jumlah baris per halaman
                    $firstChunk = $barangList->take($perPage);
                @endphp
                @foreach ($firstChunk as $index => $b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $b->kode_barang }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->seri ?? '-' }}</td>
                        <td>{{ $b->stok_awal }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <!-- Halaman 2 Daftar Barang (selalu ditampilkan) -->
        <div class="page">
            <h3 style="text-align:center">Daftar Barang</h3>
            <p style="text-align:center; margin-bottom: 10px; font-size: 14px;">Halaman 2</p>
            
            <table>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Seri</th>
                    <th>Stok Awal</th>
                </tr>
                @php
                    $secondChunk = $barangList->slice($perPage);
                @endphp
                @if ($secondChunk->isEmpty())
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 80px 20px; color: #888;">
                            <em>Lanjutan Daftar Barang<br>(Tidak ada data tambahan)</em>
                        </td>
                    </tr>
                @else
                    @foreach ($secondChunk as $index => $b)
                        <tr>
                            <td>{{ $perPage + $index + 1 }}</td>
                            <td>{{ $b->kode_barang }}</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->seri ?? '-' }}</td>
                            <td>{{ $b->stok_awal }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

@if ($months->isNotEmpty())
    @php 
        $firstMonth = $months->keys()->first(); 
    @endphp

    @include('page.bukuStok.flipbook_month', [
        'bulan'         => $firstMonth,
        'masukItems'    => $months[$firstMonth]->where('tipe_transaksi', 'masuk'),
        'keluarItems'   => $months[$firstMonth]->where('tipe_transaksi', 'keluar'),
        'summary'       => $summaries->get($firstMonth) ?? [],
        'barangSummary' => $barangSummary ?? []   // kalau ada
    ])
@endif

    </div>
   <script src="{{ asset('js/page-flip.browser.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const book = document.getElementById("book");
        const pageFlip = new St.PageFlip(book, {
            width: 600,
            height: 1500,
            showCover: true,
            maxShadowOpacity: 0.2,
            mobileScrollSupport: false
        });

        const allMonths = @json($months->keys()->toArray());
        const loadedMonths = new Set(['{{ $firstMonth ?? '' }}']);

        pageFlip.loadFromHTML(document.querySelectorAll(".page"));
        pageFlip.update();

        // Hide original pages
        document.querySelectorAll("#book .page").forEach(el => el.style.display = "none");

        const totalPagesEl = document.querySelector(".page-total");
        const currentSpan = document.querySelector(".page-current");

        totalPagesEl.innerText = Math.max(0, pageFlip.getPageCount() - 1);
        currentSpan.innerText = 'Cover';

        // Lazy Load
        const loadMonth = async (month) => {
            if (loadedMonths.has(month)) return;

            try {
                const response = await fetch(`/bukuStok/month/${month}`);  // ← Perbaikan route
                const html = await response.text();

                book.insertAdjacentHTML('beforeend', html);

                const currentPage = pageFlip.getCurrentPageIndex();
                pageFlip.updateFromHtml(document.querySelectorAll(".page"));
                pageFlip.turnToPage(currentPage);

                document.querySelectorAll("#book .page").forEach(el => el.style.display = "none");

                loadedMonths.add(month);
                totalPagesEl.innerText = Math.max(0, pageFlip.getPageCount() - 1);

            } catch (error) {
                console.error('Gagal load bulan:', month, error);
            }
        };

        document.querySelector(".btn-prev").addEventListener("click", () => pageFlip.flipPrev());
        document.querySelector(".btn-next").addEventListener("click", () => pageFlip.flipNext());

        pageFlip.on("flip", (e) => {
            const currentPage = e.data;
            currentSpan.innerText = currentPage === 0 ? 'Cover' : currentPage;

            const total = pageFlip.getPageCount();
            if (currentPage >= total - 3) {
                const nextMonth = allMonths.find(m => !loadedMonths.has(m));
                if (nextMonth) loadMonth(nextMonth);
            }
        });

        setTimeout(() => pageFlip.update(), 300);
    });
</script>
@endsection