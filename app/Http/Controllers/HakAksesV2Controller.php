<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\HakAksesMenu;
use App\Models\Menu;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HakAksesControllerV2 extends Controller
{
    /**
     * Kategori menu yang digunakan untuk membangun sidebar
     */
    private const MENU_CATEGORIES = [
        'home'     => ['home'],
        'master'   => ['barang', 'kategori', 'perusahaan', 'pengangkutan', 'armada', 'timbangan', 'relasi', 'user', 'hakAkses'],
        'laporan'  => ['laporanTimbangan'],
        'pengaturan' => ['pengaturan'],
    ];

    /**
     * Additional menu untuk pengaturan (khusus saat status diterima)
     */
    private const PENGATURAN_EXTRA = [
        'pengaturanToko'   => ['url' => '/pengaturanToko',   'icon' => 'store'],
        'pengaturanStruk'  => ['url' => '/pengaturanStruk',  'icon' => 'receipt'],
        'pengaturanTimbangan' => ['url' => '/pengaturanTimbangan', 'icon' => 'scale'],
    ];

    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }

        $hakAksesMenu = Menu::all();

        return view('page.hakAkses.index', compact('hakAksesMenu'));
    }

    public function getDataTable(Request $request)
    {
        $idToko = session('id_toko');

        $hakAkses = HakAkses::where('id_toko', $idToko)
            ->select(['id_hak_akses', 'nama_hak_akses', 'created_at'])
            ->get();

        return DataTables::of($hakAkses)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Cek hak akses user + generate sidebar menu
     */
    public function cekHakAkses(Request $request)
    {
        $idToko = session('id_toko');
        $username = session('username');
        $menuRequest = $request->menu ?? 'home';

        // User belum pilih toko
        if ($username && !$idToko) {
            return $menuRequest === 'home'
                ? response()->json(['status' => 'chooseToko'])
                : response()->json([
                    'status' => 'error',
                    'message' => 'Anda Tidak Punya Akses',
                    'firstMenuUrl' => 'home'
                ]);
        }

        $user = $this->getCurrentUser($idToko, $username);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        $toko = Pengaturan::where('id_toko', $idToko)->first();
        $statusPengajuan = $toko->status_pengajuan_toko;

        // Cek status pengajuan toko
        if (in_array($statusPengajuan, ['proses', 'ditolak'])) {
            if ($menuRequest !== 'home' && $menuRequest !== 'pengaturanToko') {
                $message = $statusPengajuan === 'proses'
                    ? 'Toko Anda Sedang Dalam Verifikasi'
                    : 'Toko Anda Sedang Dibatasi';

                return response()->json([
                    'status' => 'error',
                    'message' => $message,
                    'firstMenuUrl' => 'home'
                ]);
            }
        }

        $hakAksesMenu = $this->getHakAksesMenu($user->id_hak_akses);

        $isi = $this->buildSidebarMenu($hakAksesMenu, $menuRequest, $statusPengajuan);

        $menuArray = $hakAksesMenu->pluck('url', 'nama_menu_opsional')->toArray();

        // Tambah menu tambahan untuk pengaturan
        if (array_key_exists('pengaturan', $menuArray)) {
            $menuArray = array_merge($menuArray, array_column(self::PENGATURAN_EXTRA, 'url', 'pengaturanToko'));
        }

        if (array_key_exists($menuRequest, $menuArray)) {
            return response()->json([
                'status' => 'success',
                'data'   => $isi,
                'toko'   => $statusPengajuan
            ]);
        }

        $firstMenuUrl = collect($menuArray)
            ->except(['home', 'absen', 'absenQr'])
            ->first();

        return response()->json([
            'status' => 'error',
            'message' => 'Hak akses tidak ditemukan',
            'firstMenuUrl' => $firstMenuUrl
        ]);
    }

    private function getCurrentUser($idToko, $username)
    {
        return User::where('username', $username)
            ->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')
            ->where('user_has_toko.id_toko', $idToko)
            ->first(['user.id_user', 'user.id_hak_akses']);
    }

    private function getHakAksesMenu($idHakAkses)
    {
        return HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
            ->orderBy('menu.nama_menu_opsional')
            ->get();
    }

    /**
     * Bangun HTML sidebar menu
     */
    private function buildSidebarMenu($hakAksesMenu, $currentMenu, $statusPengajuan)
    {
        $isi = '';

        foreach (self::MENU_CATEGORIES as $category => $allowedMenus) {
            $categoryMenus = $hakAksesMenu->whereIn('nama_menu_opsional', $allowedMenus);

            if ($categoryMenus->isEmpty()) {
                continue;
            }

            $isi .= $this->buildCategoryHeader($category);

            foreach ($allowedMenus as $menuName) {
                $menuItem = $categoryMenus->where('nama_menu_opsional', $menuName)->first();

                if (!$menuItem) {
                    continue;
                }

                if ($category === 'pengaturan') {
                    $isi .= $this->buildPengaturanMenu($currentMenu, $statusPengajuan);
                } else {
                    $isi .= $this->buildSingleMenuItem($menuItem, $currentMenu);
                }
            }
        }

        return $isi;
    }
    /**
     * Bangun header kategori (Home, Master, Laporan, dll)
     */
    private function buildCategoryHeader(string $category): string
    {
        $categoryName = ucfirst($category);

        return <<<HTML
            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                         class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>{$categoryName}</span>
                </div>
            </li>
HTML;
    }

    /**
     * Bangun satu item menu biasa
     */
    private function buildSingleMenuItem($menuItem, $currentMenu): string
    {
        $active = ($currentMenu === $menuItem->nama_menu_opsional) ? 'active' : '';
        $bgColor = $active ? 'background: #2196f7; color: white;' : 'background-color: white;';
        $textColor = $active ? 'color: white;' : 'color: #3b3f5c;';

        return <<<HTML
            <li class="menu {$active}">
                <a href="{$menuItem->url}" style="{$bgColor} text-decoration: none;" 
                   aria-expanded="true" class="dropdown-toggle">
                    <div>
                        <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                            {$menuItem->icon}
                        </span>
                        <span style="margin-left:25px;{$textColor}font-weight:600">
                            {$menuItem->nama_menu}
                        </span>
                    </div>
                </a>
            </li>
HTML;
    }

    /**
     * Bangun menu tambahan di bagian Pengaturan
     */
    private function buildPengaturanMenu($currentMenu, $statusPengajuan): string
    {
        $isi = '';

        foreach (self::PENGATURAN_EXTRA as $name => $data) {
            $active = ($currentMenu === $name) ? 'active' : '';
            $bgColor = $active ? 'background: #2196f7; color: white;' : 'background-color: white;';
            $textColor = $active ? 'color: white;' : 'color: #3b3f5c;';
            $menuName = ucfirst($name);

            $isi .= <<<HTML
                <li class="menu {$active}">
                    <a href="{$data['url']}" style="{$bgColor} text-decoration: none;" 
                       aria-expanded="true" class="dropdown-toggle">
                        <div>
                            <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                {$data['icon']}
                            </span>
                            <span style="margin-left:25px;{$textColor}font-weight:600">
                                {$menuName}
                            </span>
                        </div>
                    </a>
                </li>
HTML;
        }

        return $isi;
    }
    public function detailHakAkses(string $idHakAkses)
    {
        $menuIds = HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->pluck('id_menu');

        return response()->json(['status' => 'success', 'data' => $menuIds]);
    }

    public function updateHakAkses(Request $request, string $id)
    {
        $idToko = session('id_toko');
        $newMenus = $request->menus ?? [];

        $existing = HakAksesMenu::where('id_hak_akses', $id)
            ->pluck('id_menu')
            ->toArray();

        $toAdd = array_diff($newMenus, $existing);
        $toRemove = array_diff($existing, $newMenus);

        // Jangan hapus menu "home"
        $homeId = Menu::where('nama_menu_opsional', 'home')->value('id_menu');
        $toRemove = array_filter($toRemove, fn($id) => $id !== $homeId);

        HakAksesMenu::where('id_hak_akses', $id)
            ->whereIn('id_menu', $toRemove)
            ->delete();

        foreach ($toAdd as $menuId) {
            HakAksesMenu::create([
                'id_hak_akses' => $id,
                'id_menu'      => $menuId,
                'id_toko'      => $idToko,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Hak akses berhasil diupdate']);
    }

    public function store(Request $request)
    {
        $request->validate(['nama_hak_akses' => 'required|string|max:100']);

        HakAkses::create([
            'nama_hak_akses' => $request->nama_hak_akses,
            'id_toko'        => session('id_toko'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Hak akses berhasil ditambahkan']);
    }

    public function destroy(string $id)
    {
        $idToko = session('id_toko');

        // Cek apakah masih digunakan user
        $used = User::where('id_hak_akses', $id)
            ->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')
            ->where('user_has_toko.id_toko', $idToko)
            ->exists();

        if ($used) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hak akses sedang digunakan oleh user'
            ]);
        }

        HakAksesMenu::where('id_hak_akses', $id)->delete();
        HakAkses::where('id_hak_akses', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Hak akses berhasil dihapus']);
    }

    public function getFirstMenu(string $idHakAkses)
    {
        $firstMenu = HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
            ->orderBy('menu.nama_menu_opsional')
            ->first();

        return $firstMenu ? response($firstMenu->nama_menu_opsional) : response(0);
    }
}