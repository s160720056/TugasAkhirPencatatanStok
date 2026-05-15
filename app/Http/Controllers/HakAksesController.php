<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\HakAksesMenu;
use App\Models\Menu;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $id_toko = session()->get('id_toko');

        $hakAksesMenu = Menu::get();

        return view('page.hakAkses.index', compact('hakAksesMenu'));
    }

    // getDatatable
    public function getDataTable(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $hakAkses = HakAkses::where('id_toko', $id_toko)->get();

        return DataTables::of($hakAkses)
            ->addIndexColumn()
            ->make(true);
    }

    public function cekHakAkses(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $username = session()->get('username');
        $menu = $request->menu ?? 'home';
        if ($username != null && $id_toko == null) {
            if ($menu != 'home') {
                return response()->json(['status' => 'error', 'message' => 'Anda Tidak Punya Akses', 'firstMenuUrl' => 'home']);
            } else {
                return response()->json(['status' => 'chooseToko', 'message' => '', 'firstMenuUrl' => 'home']);
            }
        }
        $user = User::where('user.username', $username)
            ->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')
            ->join('toko', 'user_has_toko.id_toko', '=', 'toko.id_toko')
            ->where('toko.id_toko', $id_toko)
            ->first();
        $idHakAkses = $user->id_hak_akses;
        $toko = Pengaturan::where('id_toko', $id_toko)->first();
        $status_pengajuan = $toko->status_pengajuan_toko;
        $hakAksesMenu = HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
            ->orderBy('menu.nama_menu_opsional')
            ->get();
        $menuArray = $hakAksesMenu->pluck('url', 'nama_menu_opsional')->toArray();
        if (array_key_exists('pengaturan', $menuArray)) {
            $menuArray['pengaturanToko'] = '/pengaturanToko';
            // $menuArray['pengaturanStruk'] = '/pengaturanStruk';
            // $menuArray['pengaturanAbsensi'] = "/pengaturanAbsensi";
            // $menuArray['pengaturanPoin'] = "/pengaturanPoin";
        }
        $dataCategories = [
            'home' => ['home'],
            'master' => ['barang', 'transaksi', 'bukuStok','rekapStokBarang', 'user', 'hakAkses'],
            'pengaturan' => ['pengaturan'],
        ];
        $isi = '';
        if ($status_pengajuan != 'diterima') {
            foreach ($dataCategories as $category => $data) {
                $categoryMenus = $hakAksesMenu->whereIn('nama_menu_opsional', $data);

                if ($categoryMenus->isNotEmpty()) {
                    $isi .= '<li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>'.ucfirst($category).'</span>
            </div>
            </li>';

                    foreach ($data as $menuName) {
                        $hakAksesMenus = $categoryMenus->where('nama_menu_opsional', $menuName)->first();
                        if ($hakAksesMenus) {
                            if ($category == 'pengaturan' && $status_pengajuan == 'ditolak') {
                                $additionalMenus = ['pengaturanToko'];
                                $urls = ['/pengaturanToko'];
                                $icons = ['store'];
                                foreach ($additionalMenus as $index => $additionalMenu) {
                                    $activeClass = ($menu == $additionalMenu) ? 'active' : '';
                                    $backgroundColor = ($activeClass == 'active') ? 'background: #166534; color: white;' : 'background-color: white;';
                                    $namaMenuColor = ($activeClass == 'active') ? 'color: white;' : 'color: #3b3f5c;';
                                    $isi .= "<li class=\"menu $activeClass\">
                                    <a href=\"".$urls[$index]."\" id=\"absen\" style=\"$backgroundColor; text-decoration: none;\"
                                    aria-expanded=\"true\" class=\"dropdown-toggle\">
                                    <div class=\"\">
                                    <span class=\"material-symbols-outlined\" style=\"font-size: 24px; color: #b1b3c3;\">
                                    ".$icons[$index]."
                                    </span>
                                    <span style=\"margin-left:25px;$namaMenuColor;font-weight:600\">".ucfirst($additionalMenu).'</span>
                                    </div>
                                    </a>
                                    </li>';
                                }
                            } else {
                                $activeClass = ($menu == $hakAksesMenus->nama_menu_opsional) ? 'active' : '';
                                $backgroundColor = ($activeClass == 'active') ? 'background: #166534; color: white;' : 'background-color: white; opacity: 0.5;';
                                $namaMenuColor = ($activeClass == 'active') ? 'color: white;' : 'color: #3b3f5c; opacity: 0.5;';
                                $isi .= "<li class=\"menu $activeClass\">
                                <a href=\"#\" id=\"absen\" style=\"$backgroundColor; text-decoration: none;\"
                                aria-expanded=\"true\" class=\"dropdown-toggle\">
                                <div class=\"\">
                                <span class=\"material-symbols-outlined\" style=\"font-size: 24px; color: #b1b3c3;\">
                                $hakAksesMenus->icon
                                </span>
                                <span style=\"margin-left:25px;$namaMenuColor;font-weight:600\">".$hakAksesMenus->nama_menu.'</span>
                                </div>
                                </a>
                                </li>';
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($dataCategories as $category => $data) {
                $categoryMenus = $hakAksesMenu->whereIn('nama_menu_opsional', $data);
                // dd($categoryMenus);
                if ($categoryMenus->isNotEmpty()) {
                    $isi .= '<li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>'.ucfirst($category).'</span>
            </div>
            </li>';

                    foreach ($data as $menuName) {
                        $hakAksesMenus = $categoryMenus->where('nama_menu_opsional', $menuName)->first();

                        if ($hakAksesMenus) {
                            if ($category == 'pengaturan') {
                                $additionalMenus = ['pengaturanToko'];
                                $urls = ['/pengaturanToko'];
                                $icons = ['store'];
                                foreach ($additionalMenus as $index => $additionalMenu) {
                                    $activeClass = ($menu == $additionalMenu) ? 'active' : '';
                                    $backgroundColor = ($activeClass == 'active') ? 'background: #166534; color: white;' : 'background-color: white;';
                                    $namaMenuColor = ($activeClass == 'active') ? 'color: white;' : 'color: #3b3f5c;';
                                    $isi .= "<li class=\"menu $activeClass\">
            <a href=\"".$urls[$index]."\" id=\"absen\" style=\"$backgroundColor; text-decoration: none;\"
            aria-expanded=\"true\" class=\"dropdown-toggle\">
            <div class=\"\">
            <span class=\"material-symbols-outlined\" style=\"font-size: 24px; color: #b1b3c3;\">
            ".$icons[$index]."
            </span>
            <span style=\"margin-left:25px;$namaMenuColor;font-weight:600\">".ucfirst($additionalMenu).'</span>
            </div>
            </a>
            </li>';
                                }
                            } else {

                                $activeClass = ($menu == $hakAksesMenus->nama_menu_opsional) ? 'active' : '';
                                $backgroundColor = ($activeClass == 'active') ? 'background: #166534; color: white;' : 'background-color: white;';
                                $namaMenuColor = ($activeClass == 'active') ? 'color: white;' : 'color: #3b3f5c;';
                                $isi .= "<li class=\"menu $activeClass\">
            <a href=\"".$hakAksesMenus->url."\" id=\"absen\" style=\"$backgroundColor; text-decoration: none;\"
            aria-expanded=\"true\" class=\"dropdown-toggle\">
            <div class=\"\">
            <span class=\"material-symbols-outlined\" style=\"font-size: 24px; color: #b1b3c3;\">
            $hakAksesMenus->icon
            </span>
            <span style=\"margin-left:25px;$namaMenuColor;font-weight:600\">".$hakAksesMenus->nama_menu.'</span>
            </div>
            </a>
            </li>';
                            }
                        }
                    }
                }
            }
        }

        if ($status_pengajuan == 'ditolak') {
            if ($menu != 'home') {
                if ($menu != 'pengaturanToko') {
                    return response()->json(['status' => 'error', 'message' => 'Toko Anda Sedang Dibatasi', 'firstMenuUrl' => 'home']);
                }
            }
        } elseif ($status_pengajuan == 'proses') {
            if ($menu != 'home') {
                if ($menu != 'pengaturanToko') {
                    return response()->json(['status' => 'error', 'message' => 'Toko Anda Sedang Dalam Verifikasi', 'firstMenuUrl' => 'home']);
                }
            }
        }

        if (array_key_exists($menu, $menuArray)) {
            return response()->json(['status' => 'success', 'message' => 'Hak akses ditemukan', 'data' => $isi, 'toko' => $toko->status_pengajuan_toko]);
        } else {
            $firstMenuUrl = collect($menuArray)->except(['home', 'absen', 'absenQr'])->first();

            return response()->json(['status' => 'error', 'message' => 'Hak akses Tidak ditemukan', 'firstMenuUrl' => $firstMenuUrl]);
        }
    }

    // detailHakAkses
    public function detailHakAkses(string $idHakAkses)
    {
        $id_toko = session()->get('id_toko');
        $hakAkses = HakAkses::where('id_toko', $id_toko)->where('id_hak_akses', $idHakAkses)->first();
        $hakAksesMenu = HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
            ->get();
        $menu = [];
        // insert only idmenu
        foreach ($hakAksesMenu as $hakAksesMenus) {
            array_push($menu, $hakAksesMenus->id_menu);
        }

        return response()->json(['status' => 'success', 'data' => $menu]);
    }

    // updateHakAkses
    public function updateHakAkses(Request $request, string $id)
    {
        $id_toko = session()->get('id_toko');
        $menu = $request->menus;

        $existingMenus = HakAksesMenu::where('id_hak_akses', $id)->pluck('id_menu')->toArray();

        $menusToAdd = array_diff($menu, $existingMenus);
        $menusToRemove = array_diff($existingMenus, $menu);

        $homeMenuId = Menu::where('nama_menu_opsional', 'home')->value('id_menu');
        if (($key = array_search($homeMenuId, $menusToRemove)) !== false) {
            unset($menusToRemove[$key]);
        }

        HakAksesMenu::where('id_hak_akses', $id)
            ->whereIn('id_menu', $menusToRemove)
            ->delete();

        foreach ($menusToAdd as $menuId) {
            $hakAksesMenu = new HakAksesMenu;
            $hakAksesMenu->id_hak_akses = $id;
            $hakAksesMenu->id_menu = $menuId;
            $hakAksesMenu->id_toko = $id_toko;
            $hakAksesMenu->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Hak akses berhasil diupdate']);
    }

    // function untuk ambil menu pertama yang ada di hak akse
    public function getFirstMenu(string $idHakAkses)
    {
        $id_toko = session()->get('id_toko');

        $hakAksesMenu = HakAksesMenu::where('id_hak_akses', $idHakAkses)
            ->join('menu', 'hak_akses_menu.id_menu', '=', 'menu.id_menu')
            ->orderBy('menu.nama_menu_opsional')
            ->first();

        if ($hakAksesMenu) {
            return response($hakAksesMenu->nama_menu_opsional);
        } else {
            return response(0);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_toko = session()->get('id_toko');
        $nama_hak_akses = $request->nama_hak_akses;

        $hakAkses = new HakAkses;
        $hakAkses->nama_hak_akses = $nama_hak_akses;
        $hakAkses->id_toko = $id_toko;
        $hakAkses->save();
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
        $id_toko = session()->get('id_toko');
        // check if hak akses is used by any user
        $user = User::where('id_hak_akses', $id)->join('user_has_toko', 'user.id_user', '=', 'user_has_toko.id_user')->where('user_has_toko.id_toko', $id_toko)->first();
        if ($user) {
            return response()->json(['status' => 'error', 'message' => 'Hak akses sedang digunakan oleh user']);
        } else {
            HakAksesMenu::where('id_hak_akses', $id)->delete();
            HakAkses::where('id_hak_akses', $id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Hak akses berhasil dihapus']);
        }
    }
}
