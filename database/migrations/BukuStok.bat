@echo off
setlocal EnableDelayedExpansion

:: ============================================
:: MASUK KE PROJECT
:: ============================================
cd /d "c:/xampp/htdocs/TugasAkhirPencatatanStok"

:: ============================================
:: CEK APAKAH ARTISAN SERVE SUDAH BERJALAN
:: ============================================
set "ARTISAN_RUNNING=0"

for /f "tokens=2 delims=," %%a in ('
    tasklist /v /fo csv ^| findstr /i "php.exe"
') do (
    wmic process where "ProcessId=%%~a" get CommandLine /value 2>nul | findstr /i "artisan serve" >nul
    if !errorlevel! == 0 (
        set "ARTISAN_RUNNING=1"
    )
)

:: ============================================
:: JIKA ARTISAN SUDAH JALAN
:: MAKA HANYA GIT PULL + OPTIMIZE
:: ============================================
if "!ARTISAN_RUNNING!"=="1" (

    echo ============================================
    echo ARTISAN SERVE TERDETEKSI
    echo ============================================

    :: ============================================
    :: CEK INTERNET
    :: ============================================
    ping -n 1 github.com >nul 2>&1

    if !errorlevel! == 0 (

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

        @REM echo.
        @REM echo ============================================
        @REM echo OPTIMIZE LARAVEL...
        @REM echo ============================================

        @REM php artisan optimize

    ) else (

        echo ============================================
        echo TIDAK ADA KONEKSI INTERNET
        echo BYPASS GIT PULL
        echo ============================================

    )

    pause
    exit /b
)

:: ============================================
:: JIKA ARTISAN BELUM BERJALAN
:: ============================================

echo ============================================
echo ARTISAN SERVE BELUM BERJALAN
echo ============================================

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

    @REM echo.
    @REM echo ============================================
    @REM echo OPTIMIZE LARAVEL...
    @REM echo ============================================

    @REM php artisan optimize

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
:: AUTO MIGRATE
:: ============================================
php artisan migrate 

if %errorlevel%==0 (
    echo MIGRATION BERHASIL / TIDAK ADA YANG PERLU DIMIGRATE
) else (
    echo MIGRATION GAGAL
)

:: ============================================
:: JALANKAN ARTISAN SERVE
:: ============================================
start cmd /k "php artisan serve"

:: ============================================
:: TUNGGU SERVER
:: ============================================
timeout /t 2 >nul

:: ============================================
:: BUKA CHROME
:: ============================================
start chrome "http://127.0.0.1:8000"