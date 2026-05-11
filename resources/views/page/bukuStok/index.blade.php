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
            max-width: 1500px;
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
        .rekap-container {
            margin-top: 40px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>

<div class="container">
        <div>
            <button type="button" class="btn-prev">Previous page</button>
            [<span class="page-current">Cover</span> of <span class="page-total">-</span>]
            <button type="button" class="btn-next">Next page</button>
        </div>
    </div>

    <!-- ==================== FLIPBOOK ==================== -->
    <div class="flip-book" id="book">
        <!-- Cover -->
        <div class="page page-cover page-cover-top">
            <h2 style="text-align:center">BUKU STOK</h2>
            <p style="text-align:center; margin-top: 1rem;">Kartu Stok Barang</p>
        </div>

        <!-- Daftar Barang -->
        <!-- ... (Halaman 1 & 2 Daftar Barang tetap sama) ... -->
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
            @php $firstMonth = $months->keys()->first(); @endphp

            @include('page.bukuStok.flipbook_month', [
                'bulan'         => $firstMonth,
                'masukItems'    => $months[$firstMonth]->where('tipe_transaksi', 'masuk'),
                'keluarItems'   => $months[$firstMonth]->where( 'tipe_transaksi', 'keluar'),
                'summary'       => $summaries->get($firstMonth) ?? [],
                'barangSummary' => []   // tidak perlu dikirim lagi
            ])
        @endif
    </div>

    <!-- ==================== REKAP STOK DI BAWAH FLIPBOOK ==================== -->
    <div class="rekap-container mt-3">
        <h5 class="text-center mb-2" id="rekap-title">
            Rekap Stok - {{ Carbon::parse($firstMonth ?? now()->format('Y-m'))->translatedFormat('F Y') }}
        </h5>
        
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" style="font-size: 12px;">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Seri</th>
                        <th class="text-end">Stok Awal</th>
                        <th class="text-end text-success">Masuk</th>
                        <th class="text-end text-danger">Keluar</th>
                        <th class="text-end">Stok Akhir</th>
                    </tr>
                </thead>
                <tbody id="rekap-body">
                    <!-- Diisi via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
<script src="{{ asset('js/page-flip.browser.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const book = document.getElementById("book");
       const pageFlip = new St.PageFlip(book, {
            width: 845,
            height: 5000,
            showCover: true,
            maxShadowOpacity: 0,        // Matikan efek bayangan / kertas
            drawShadow: false,          // Matikan shadow sepenuhnya
            flippingTime: 600,
            usePortrait: false,
            mobileScrollSupport: false,
            startZIndex: 0,

                        // --- ADD THESE SETTINGS ---
            showCornerHover: false,      // Disables the corner animation on hover
            disableFlipByClick: true,    // Disables flipping by clicking the page
            swipeDistance: 0,            // Effectively disables mouse dragging/swiping
            clickEventForward: true,     // Allows clicks to pass through to buttons/tables
            // --------------------------
        });

        const allMonths = @json($months->keys()->toArray());
        const loadedMonths = new Set(['{{ $firstMonth ?? '' }}']);
        let currentMonth = '{{ $firstMonth }}';

        let monthMap = new Map();

        // Load halaman awal
        pageFlip.loadFromHTML(document.querySelectorAll(".page"));

        // Build Mapping dengan offset yang benar
        function buildMonthMap() {
            monthMap.clear();
            const monthPages = document.querySelectorAll('.page[data-month]');
            
            monthPages.forEach((page, arrayIndex) => {
                const month = page.getAttribute('data-month');
                // Halaman transaksi mulai dari index ke-3 di array (karena ada Cover + 2 Daftar Barang)
                const pageIndex = arrayIndex + 3;   // Offset penting!
                if (month) monthMap.set(pageIndex, month);
            });
        }

        buildMonthMap();

        const totalPagesEl = document.querySelector(".page-total");
        const currentSpan = document.querySelector(".page-current");

        totalPagesEl.innerText = Math.max(0, pageFlip.getPageCount() - 1);
        currentSpan.innerText = 'Cover';

        // Tombol Prev & Next
        document.querySelector(".btn-prev").addEventListener("click", () => pageFlip.flipPrev());
        document.querySelector(".btn-next").addEventListener("click", () => pageFlip.flipNext());

        // Lazy Load
        const loadMonth = async (month) => {
            if (loadedMonths.has(month)) return;

            try {
                const response = await fetch(`/bukuStok/month/${month}`);
                const html = await response.text();

                book.insertAdjacentHTML('beforeend', html);
                pageFlip.updateFromHtml(document.querySelectorAll(".page"));

                loadedMonths.add(month);
                totalPagesEl.innerText = Math.max(0, pageFlip.getPageCount() - 1);

                setTimeout(buildMonthMap, 400);
            } catch (error) {
                console.error('Gagal load bulan:', month, error);
            }
        };

        // Update Rekap
        const updateRekap = (month) => {
            // if (month === currentMonth) return;
            currentMonth = month;

            document.getElementById('rekap-title').textContent = 
                `Rekap Stok - ${new Date(month + '-01').toLocaleString('id-ID', { month: 'long', year: 'numeric' })}`;

            fetch(`/bukuStok/rekap/${month}`)
                .then(r => r.json())
                .then(data => {
                    let html = '';
                    data.forEach(b => {
                        html += `
                            <tr>
                                <td>${b.kode_barang}</td>
                                <td>${b.nama_barang}</td>
                                <td>${b.seri || '-'}</td>
                                <td class="text-end">${Number(b.stok_awal).toLocaleString('id-ID')}</td>
                                <td class="text-end text-success">+${Number(b.masuk).toLocaleString('id-ID')}</td>
                                <td class="text-end text-danger">-${Number(b.keluar).toLocaleString('id-ID')}</td>
                                <td class="text-end fw-bold">${Number(b.stok_akhir).toLocaleString('id-ID')}</td>
                            </tr>`;
                    });
                    document.getElementById('rekap-body').innerHTML = html;
                });
        };

        // Event Flip
        pageFlip.on("flip", (e) => {
            const currentIndex = e.data;
            currentSpan.innerText = currentIndex === 0 ? 'Cover' : currentIndex + 1;

            // Ambil bulan dari mapping
            const activeMonth = monthMap.get(currentIndex);
            
            if (activeMonth) {
                
                updateRekap(activeMonth);
            }

            // Lazy load
            const total = pageFlip.getPageCount();
            if (currentIndex >= total - 4) {
                const nextMonth = allMonths.find(m => !loadedMonths.has(m));
                if (nextMonth) loadMonth(nextMonth);
            }
        });

        // Backup update
        pageFlip.on("update", () => {
            const currentIndex = pageFlip.getCurrentPageIndex();
            const activeMonth = monthMap.get(currentIndex);
            if (activeMonth) updateRekap(activeMonth);
        });

        // Inisialisasi
        if ('{{ $firstMonth }}') {
            updateRekap('{{ $firstMonth }}');
        }

        setTimeout(() => {
            pageFlip.update();
            buildMonthMap();
        }, 800);
    });
</script>
@endsection