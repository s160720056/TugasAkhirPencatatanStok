@echo off
setlocal EnableDelayedExpansion

:: Check if php artisan serve is already running
tasklist | findstr /I "php.exe" >nul
if %errorlevel%==0 (
    powershell -Command "[System.Windows.MessageBox]::Show('PHP Artisan Serve is already running.', 'Information', 'OK', 'Information')"
    exit /b
)

:: Change directory to target location, pull latest changes, and run php artisan serve
cd /d "c:/xampp/htdocs/TugasAkhirPencatatanStok"


start cmd /k "php artisan serve"

:: Open Google Chrome to localhost
start chrome "http://127.0.0.1:8000"
