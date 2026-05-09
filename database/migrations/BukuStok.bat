@echo off
setlocal EnableDelayedExpansion

:: ============================================
:: CHECK apakah php artisan serve sudah jalan
:: ============================================
tasklist | findstr /I "php.exe" >nul
if %errorlevel%==0 (
    powershell -Command "[System.Windows.MessageBox]::Show('PHP Artisan Serve is already running.', 'Information', 'OK', 'Information')"
    exit /b
)

:: ============================================
:: MASUK KE PROJECT
:: ============================================
cd /d "c:/xampp/htdocs/TugasAkhirPencatatanStok"

:: ============================================
:: CEK KONEKSI INTERNET
:: ============================================
ping -n 1 github.com >nul 2>&1

if %errorlevel%==0 (
    echo ============================================
    echo INTERNET TERDETEKSI
    echo MENJALANKAN GIT PULL...
    echo ============================================

    git pull

    echo.
    echo ============================================
    echo MEMBERSIHKAN CACHE LARAVEL...
    echo ============================================

    php artisan optimize:clear

) else (
    echo ============================================
    echo TIDAK ADA KONEKSI INTERNET
    echo BYPASS GIT PULL
    echo ============================================
)

echo.
echo ============================================
echo CEK MIGRATION LARAVEL...
echo ============================================

:: ============================================
:: AUTO MIGRATE JIKA ADA YANG BELUM
:: ============================================
php artisan migrate --force

if %errorlevel%==0 (
    echo MIGRATION BERHASIL / TIDAK ADA YANG PERLU DIMIGRATE
) else (
    echo MIGRATION GAGAL
)

:: ============================================
:: JALANKAN LARAVEL
:: ============================================
start cmd /k "php artisan serve"

:: ============================================
:: BUKA CHROME
:: ============================================
timeout /t 2 >nul
start chrome "http://127.0.0.1:8000"