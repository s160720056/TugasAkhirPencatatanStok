<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kesalahan Server Internal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        .error-number {
            font-size: 9rem;
            line-height: 1;
            font-weight: 700;
            background: linear-gradient(90deg, #ef4444, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center p-6">
    <div class="max-w-lg w-full text-center">

        <!-- Icon -->
        <div class="mx-auto mb-8 flex justify-center">
            <div class="w-28 h-28 bg-red-500/10 border border-red-500/30 rounded-3xl flex items-center justify-center text-7xl shadow-inner">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

        <!-- Error Code -->
        <h1 class="error-number">500</h1>

        <h2 class="text-4xl font-semibold tracking-tight mt-1 mb-4">Kesalahan Server Internal</h2>

        <!-- Friendly message -->
        <p class="text-zinc-400 text-xl mb-8">
            Maaf sekali! 😔 Terjadi kesalahan tak terduga di sisi server kami.<br>
            Tim teknis sudah mendapat notifikasi dan sedang memperbaikinya.
        </p>

        <!-- Helpful explanation -->
        <div class="card bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-12 text-left">
            <p class="text-red-400 text-sm font-medium mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-info"></i>
                Penyebab umum:
            </p>
            <ul class="space-y-3 text-zinc-300 text-[15px]">
                <li class="flex gap-3">
                    <span class="text-red-400 font-medium">•</span>
                    Ada bug di kode aplikasi
                </li>
                <li class="flex gap-3">
                    <span class="text-red-400 font-medium">•</span>
                    Masalah koneksi database
                </li>
                <li class="flex gap-3">
                    <span class="text-red-400 font-medium">•</span>
                    Server sedang overload / sibuk
                </li>
                <li class="flex gap-3">
                    <span class="text-red-400 font-medium">•</span>
                    Konfigurasi server bermasalah
                </li>
            </ul>
        </div>

        <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <!-- Kembali -->
            <button onclick="history.back()"
                    class="flex-1 flex items-center justify-center gap-3 bg-white text-zinc-900 hover:bg-amber-300 active:scale-95 transition-all font-semibold py-5 px-8 rounded-3xl text-lg">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Halaman Sebelumnya
            </button>

            <!-- Coba Lagi -->
            <button onclick="window.location.reload()"
                    class="flex-1 flex items-center justify-center gap-3 bg-zinc-800 hover:bg-zinc-700 active:scale-95 transition-all font-medium py-5 px-8 rounded-3xl text-lg border border-zinc-700">
                <i class="fa-solid fa-rotate"></i>
                Coba Lagi
            </button>

            <!-- Ke Beranda -->
            <a href="/"
               class="flex-1 flex items-center justify-center gap-3 bg-white text-zinc-900 hover:bg-amber-300 active:scale-95 transition-all font-semibold py-5 px-8 rounded-3xl text-lg">
                <i class="fa-solid fa-house"></i>
                Ke Beranda
            </a>
        </div>

        <!-- Footer info -->
        <p class="mt-12 text-zinc-500 text-sm">
            Masih bingung?
            <a href="mailto:xtrac8996@gmail.com" class="underline hover:text-red-400 transition-colors">Hubungi support kami</a>
        </p>

        <div class="mt-8 text-[10px] text-zinc-600 font-mono tracking-widest">
            HTTP 500 • INTERNAL SERVER ERROR
        </div>
    </div>

    <script>
        // Inisialisasi Tailwind
        tailwind.config = {
            content: [],
            theme: {
                extend: {}
            }
        }
    </script>
</body>
</html>
