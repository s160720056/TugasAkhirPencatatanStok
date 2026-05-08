<?php

namespace App\Http\Controllers;

// model Toko
use App\Models\Pengaturan;
use App\Models\User;
use App\Models\UserHasToko;
// connect controller hakakses
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
{
    $id_toko = session('id_toko');
    $username = session('username');

    $user = User::where('username', $username)->first();
    if (! $user) {
        return redirect('/login');
    }

    $listToko = UserHasToko::where('id_user', $user->id_user)
        ->join('toko', 'user_has_toko.id_toko', '=', 'toko.id_toko')
        ->get();

    // auto set toko
    if (! $id_toko && $user->ownership == 0 && $listToko->isNotEmpty()) {
        $idtoko = $listToko->first()->id_toko;
        session(['id_toko' => $idtoko]);
        $this->connectToTokoDatabase($idtoko);

        return redirect()->route('home.index');
    }
    $toko       = Pengaturan::where('id_toko', $id_toko)->first();
    $pengaturan = $toko;

    return view('page.home', compact(
        'toko',
        'pengaturan',
        'listToko',
        'id_toko'
    ));



}
    // public function index()
    // {
    //     $id_toko = session('id_toko');
    //     $username = session('username');

    //     $user = User::where('username', $username)->first();
    //     if (! $user) {
    //         return redirect('/login');
    //     }

    //     $listToko = UserHasToko::where('id_user', $user->id_user)
    //         ->join('toko', 'user_has_toko.id_toko', '=', 'toko.id_toko')
    //         ->get();

    //     // auto set toko
    //     if (! $id_toko && $user->ownership == 0 && $listToko->isNotEmpty()) {
    //         $idtoko = $listToko->first()->id_toko;
    //         session(['id_toko' => $idtoko]);
    //         $this->connectToTokoDatabase($idtoko);

    //         return redirect()->route('home.index');
    //     }

    //     $toko = Pengaturan::where('id_toko', $id_toko)->first();
    //     $pengaturan = $toko;

    //     if (! $id_toko) {
    //         return view('page.home', compact('toko', 'pengaturan', 'listToko', 'id_toko'));
    //     }

    //     // ================== DASHBOARD ==================
    //     $yearNow = now()->year;
    //     $yearBefore = $yearNow - 1;
    //     $bulan = now()->month;

    //     // 🔥 1 QUERY untuk KPI utama
    //     $kpi = Timbangan::selectRaw('
    //             COUNT(CASE WHEN YEAR(created_at) = ? THEN 1 END) as tahun_ini,
    //             COUNT(CASE WHEN YEAR(created_at) = ? THEN 1 END) as tahun_lalu,
    //             AVG(CASE WHEN YEAR(created_at) = ? AND MONTH(created_at) = ? THEN berat_netto2 END) as avg_bulan_ini,
    //             COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as hari_ini,
    //             SUM(CASE WHEN YEAR(created_at) = ? THEN berat_netto2 END) as total_tahun_ini,
    //             AVG(CASE WHEN created_at BETWEEN ? AND ? THEN berat_netto2 END) as avg_minggu_ini,
    //             MAX(berat_netto2) as max_berat
    //         ', [
    //         $yearNow,
    //         $yearBefore,
    //         $yearNow,
    //         $bulan,
    //         $yearNow,
    //         now()->startOfWeek(),
    //         now()->endOfWeek(),
    //     ])->first();

    //     $totalTimbanganTahunIni = $kpi->tahun_ini ?? 0;
    //     $totalTimbanganTahunLalu = $kpi->tahun_lalu ?? 0;

    //     // YoY
    //     $yoy = $totalTimbanganTahunLalu == 0
    //         ? ($totalTimbanganTahunIni > 0 ? 100 : 0)
    //         : ($totalTimbanganTahunIni - $totalTimbanganTahunLalu) / $totalTimbanganTahunLalu * 100;

    //     $rataRataBeratBulanIni = $kpi->avg_bulan_ini ?? 0;
    //     $timbanganHariIni = $kpi->hari_ini ?? 0;
    //     $beratTotalTahunIni = $kpi->total_tahun_ini ?? 0;
    //     $rataRataMingguIni = $kpi->avg_minggu_ini ?? 0;
    //     $timbanganTerberat = $kpi->max_berat ?? 0;

    //     // ================== DISTRIBUSI ==================
    //     $bagi4 = $timbanganTerberat / 4;

    //     $terendah = $timbanganTerberat - ($bagi4 * 3);
    //     $range1 = $timbanganTerberat - ($bagi4 * 2);
    //     $range2 = $timbanganTerberat - $bagi4;
    //     $tinggi = $timbanganTerberat;

    //     // 🔥 1 QUERY untuk distribusi
    //     $distribusi = Timbangan::selectRaw('
    //             COUNT(CASE WHEN berat_netto2 < ? THEN 1 END) as terendah,
    //             COUNT(CASE WHEN berat_netto2 >= ? AND berat_netto2 < ? THEN 1 END) as range1,
    //             COUNT(CASE WHEN berat_netto2 >= ? AND berat_netto2 < ? THEN 1 END) as range2,
    //             COUNT(CASE WHEN berat_netto2 >= ? THEN 1 END) as tinggi
    //         ', [
    //         $terendah,
    //         $terendah,
    //         $range1,
    //         $range1,
    //         $range2,
    //         $range2,
    //     ])->first();

    //     $listTimbanganTerberat = compact('terendah', 'range1', 'range2', 'tinggi');

    //     $listJumlahTimbanganTerberat = [
    //         'terendah' => $distribusi->terendah ?? 0,
    //         'range1' => $distribusi->range1 ?? 0,
    //         'range2' => $distribusi->range2 ?? 0,
    //         'tinggi' => $distribusi->tinggi ?? 0,
    //     ];

    //     $topBarangPalingSeringTimbang = Timbangan::selectRaw('
    //             nama_stok,
    //             COUNT(berat_netto2) as jumlah
    //         ')
    //         ->groupBy('nama_stok')
    //         ->orderByDesc('jumlah')
    //         ->limit(10)
    //         ->get();
    //     // dd($topBarangPalingSeringTimbang);
    //     // jumlah timbangan perhari (7 hari terakhir)
    //     // ================== 7 HARI (OPTIMIZED) ==================
    //     $startDate = now()->subDays(6)->startOfDay();
    //     $endDate = now()->endOfDay();
    //     $dailyCounts = Timbangan::selectRaw('
    //     DATE(created_at) as date,
    //     COUNT(*) as total
    //    ')
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->groupByRaw('DATE(created_at)')
    //         ->orderByRaw('DATE(created_at)')
    //         ->get()
    //         ->keyBy('date');
    //     $dates = collect(range(0, 6))->map(
    //         fn ($i) => $startDate->copy()->addDays($i)->format('Y-m-d')
    //     );
    //     $jumlahTimbanganPerHari = $dates->map(function ($date) use ($dailyCounts) {
    //         $row = $dailyCounts[$date] ?? null;

    //         return [
    //             'label' => Carbon::parse($date)->translatedFormat('D'), // Sen, Sel
    //             'value' => $row?->total ?? 0,
    //         ];
    //     });

    //     $now = Carbon::now('Asia/Jakarta');

    //     // ================== TREND MINGGUAN (10 hari terakhir) ==================
    //     $mingguanRaw = Timbangan::select([
    //         DB::raw('DATE(created_at) as tanggal'),
    //         DB::raw('ROUND(AVG(berat_netto2), 1) as rata_rata'),
    //         DB::raw('COUNT(*) as jumlah'),
    //     ])
    //         ->where('created_at', '>=', $now->copy()->subDays(9))
    //         ->groupBy('tanggal')
    //         ->orderBy('tanggal')
    //         ->get();

    //     $trendMingguan = $this->formatMingguan($mingguanRaw, $now);

    //     // ================== TREND BULANAN (tahun ini) ==================
    //     $bulananRaw = Timbangan::select([
    //         DB::raw('MONTH(created_at) as bulan'),
    //         DB::raw('ROUND(AVG(berat_netto2), 1) as rata_rata'),
    //         DB::raw('COUNT(*) as jumlah'),
    //     ])
    //         ->whereYear('created_at', $now->year)
    //         ->groupBy('bulan')
    //         ->orderBy('bulan')
    //         ->get();

    //     $trendBulanan = $this->formatBulanan($bulananRaw);

    //     return view('page.home', compact(
    //         'toko',
    //         'pengaturan',
    //         'listToko',
    //         'id_toko',
    //         'totalTimbanganTahunIni',
    //         'totalTimbanganTahunLalu',
    //         'yoy',
    //         'bulan',
    //         'rataRataBeratBulanIni',
    //         'timbanganHariIni',
    //         'beratTotalTahunIni',
    //         'rataRataMingguIni',
    //         'timbanganTerberat',
    //         'listTimbanganTerberat',
    //         'listJumlahTimbanganTerberat',
    //         'topBarangPalingSeringTimbang',
    //         'jumlahTimbanganPerHari',
    //         'trendMingguan',
    //         'trendBulanan',
    //     ));
    // }

    /**
     * Pastikan selalu ada 10 hari (kosong tetap ditampilkan = 0)
     */
    private function formatMingguan($data, $now)
    {
        $labels = [];
        $rataRata = [];
        $jumlah = [];

        for ($i = 9; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $key = $date->format('Y-m-d');

            $item = $data->firstWhere('tanggal', $key);

            $labels[] = $date->format('j M');           // contoh: "4 Apr"
            $rataRata[] = $item ? (float) $item->rata_rata : 0;
            $jumlah[] = $item ? (int) $item->jumlah : 0;
        }

        return compact('labels', 'rataRata', 'jumlah');
    }

    /**
     * Pastikan selalu ada 12 bulan (kosong tetap 0)
     */
    private function formatBulanan($data)
    {
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $rataRata = array_fill(0, 12, 0);
        $jumlah = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $index = $item->bulan - 1;
            $rataRata[$index] = (float) $item->rata_rata;
            $jumlah[$index] = (int) $item->jumlah;
        }

        return [
            'labels' => $monthNames,
            'rataRata' => $rataRata,
            'jumlah' => $jumlah,
        ];
    }
    private function formatJumlahPerHari($dailyRaw, $now)
{
    $dailyCounts = $dailyRaw->keyBy('tanggal');

    $startDate = $now->copy()->subDays(6)->startOfDay();

    return collect(range(0, 6))->map(function ($i) use ($startDate, $dailyCounts) {
        $date = $startDate->copy()->addDays($i)->format('Y-m-d');
        $row = $dailyCounts[$date] ?? null;

        return [
            'label' => Carbon::parse($date)->translatedFormat('D'), // Sen, Sel, Rab, dst
            'value' => $row?->jumlah ?? 0,
        ];
    });
}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function connectToTokoDatabase($id_toko)
    {
        $toko = DB::table('toko')->where('id_toko', $id_toko)->first();

        if (! $toko) {
            throw new \Exception("Toko not found for id_toko: $id_toko");
        }
        config([
            'database.connections.dynamic' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => env('DYNAMIC_DB').$id_toko, // Dynamic database name
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'strict' => true,
                'engine' => null,
            ],
        ]);
        DB::purge('dynamic');
        DB::setDefaultConnection('dynamic');
        try {
            DB::connection('dynamic')->getPdo();
        } catch (\Exception $e) {
            throw new \Exception("Failed to connect to the database for toko: $id_toko. ".$e->getMessage());
        }
    }

    // disconnect
    public function disconnect()
    {
        session()->forget('id_toko');
        session()->forget('nama_toko');
        $this->resetDatabaseConnection();

        return redirect()->route('home.index');
    }
}
