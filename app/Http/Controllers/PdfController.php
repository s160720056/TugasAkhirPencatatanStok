<?php

namespace App\Http\Controllers;
// use Spatie\LaravelPdf\Facades\Pdf;
// use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
// https://github.com/barryvdh/laravel-dompdf



use App\Models\Pengaturan;
use Yajra\DataTables\Facades\DataTables;

class PdfController extends Controller
{
    public function generate()
    {
        $id_toko = session()->get('id_toko');
        $pengaturan = Pengaturan::where('id_toko', $id_toko)->first();


        $pdf = Pdf::loadView('page.pdf.example', compact('pengaturan'));



        return $pdf->download('invoice.pdf');
    }
}
